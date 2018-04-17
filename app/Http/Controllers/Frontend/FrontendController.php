<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 29.08.15
 * Time: 15:53
 */

namespace App\Http\Controllers\Frontend;

use Agent;
use App\Http\Controllers\BaseController;
use App\Models\Department;
use App\Models\DepartmentItem;
use App\Models\Share;
use Config;
use GeoIP;
use Illuminate\Support\Collection;
use JavaScript;
use Lang;
use Meta;
use View;

/**
 * Class FrontendController
 * @package App\Http\Controllers\Frontend
 */
class FrontendController extends BaseController
{
    /**
     * @var string
     */
    public $module = "";
    
    /**
     * @var array
     */
    public $breadcrumbs = [];
    
    /**
     * @var bool|null
     */
    public $user = null;
    
    /**
     * @var int
     */
    public $per_page = 20;
    
    /**
     * @var Collection
     */
    public $departments;
    
    /**
     * @var array
     */
    public $current_department;
    
    /**
     * @var array
     */
    public $current_department_items_groups;
    
    /**
     * @var int
     */
    
    /**
     * constructor
     */
    function __construct()
    {
        $this->_theme = config('app.theme');
        
        parent::__construct();
        
        Meta::title(Config::get('app.name', ''));
        
        $this->breadcrumbs(Config::get('app.name', ''), route('home'));
        
        $this->departments = $this->_getDepartments();
        
        $this->current_department = $this->_getLocation();
        
        $this->current_department_items_groups = $this->getDepartmentItemsGroups();
        
        $this->fillThemeData();
    }
    
    /**
     * @param $model
     * @param $type
     */
    public function fillMeta($model, $type)
    {
        Meta::title($model->getMetaTitle());
        Meta::description($model->getMetaDescription());
        Meta::keywords($model->getMetaKeywords());
        Meta::image($model->getMetaImage());
        Meta::canonical($model->getUrl());
    }
    
    /**
     * fill additional template data
     */
    public function fillThemeData()
    {
        $max_upload_file_size = (int) ini_get("upload_max_filesize") * 1024 * 1024;
        View::share('max_upload_file_size', $max_upload_file_size);
        
        View::share('max_upload_image_width', config('image.max_upload_width'));
        View::share('max_upload_image_height', config('image.max_upload_height'));
        
        View::share('currency', trans('labels.grn'));
        
        View::share('no_image_user', config('user.no_image'));
        
        // set javascript vars
        JavaScript::put(
            [
                'app_url'                            => Config::get('app.url', ''),
                'lang'                               => Lang::getLocale(),
                'currency'                           => trans('labels.grn'),
                'max_upload_file_size'               => $max_upload_file_size,
                'max_upload_image_width'             => config('image.max_upload_width'),
                'max_upload_image_height'            => config('image.max_upload_height'),
                'lang_errorRequestError'             => trans(
                    'messages.an error has occurred, please reload the page and try again'
                ),
                'lang_errorValidation'               => trans('messages.validation_failed'),
                'lang_errorFormSubmit'               => trans('messages.error form submit'),
                'lang_authError'                     => trans('messages.auth middleware error message'),
                'lang_errorSelectedFileIsTooLarge'   => trans('messages.trying to load is too large file'),
                'lang_errorIncorrectFileType'        => trans('messages.trying to load unsupported file type'),
                'lang_errorSelectedImageWidthError'  => trans(
                    'messages.max allowed image width: :width px',
                    ['width' => config('image.max_upload_width')]
                ),
                'lang_errorSelectedImageHeightError' => trans(
                    'messages.max allowed image height: :height px',
                    ['height' => config('image.max_upload_height')]
                ),
                'lang_errorCantShowAjaxPopup'        => trans('messages.an error has occurred, try_later'),
                'no_image'                           => 'http://www.placehold.it/250x250/EFEFEF/AAAAAA&text=no+image',
                'no_image_user'                      => config('user.no_image'),
                'is_mobile'                          => Agent::isMobile(),
                'theme_url'                          => config('app.url').'/'.
                    config('theme.assets_path').'/'.$this->_theme.'/',
                'game_description'                   => trans('front_texts.game_description'),
                'city'                               => GeoIP::getLocation(),
                'contacts_label'                     => trans('front_labels.contacts'),
                'contact_markers'                    => $this->getContactMapMarkers(),
                'current_department_latitude'        => $this->current_department ?
                    $this->current_department['lat'] :
                    null,
                'current_department_longitude'       => $this->current_department ?
                    $this->current_department['lon'] :
                    null,
            ]
        );
        
        View::share('site_name', Config::get('app.name', ''));
        
        View::share("lang", Lang::getLocale());
        
        View::share("logo_title", Config::get('app.name', ''));
        
        View::share("user", $this->user);
        
        View::share("is_mobile", Agent::isMobile());
        
        View::share("google_analytics_id", Config::get('google.analytics.id', null));
        
        View::share("departments", $this->departments);
        
        View::share('current_department', $this->current_department);
        
        $this->data(
            'share',
            $this->current_department ?
                Share::with('translations')
                    ->where('department_id', $this->current_department['id'])
                    ->visible()->first() :
                null
        );
        
        $this->data('department_items_groups', $this->current_department_items_groups);
    }
    
    /**
     * @param string $view
     * @param array  $data
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render($view = '', array $data = [])
    {
        $this->data('breadcrumbs', $this->breadcrumbs);
        
        return parent::render($view, $data);
    }
    
    /**
     * @param array|null $items_groups
     *
     * @return array
     */
    public function getContactMapMarkers($items_groups = null)
    {
        $markers = [];
        $i = 0;
        
        if ($items_groups === null) {
            $items_groups = $this->current_department_items_groups;
        }
        
        foreach ($items_groups as $group => $items) {
            foreach ($items as $item) {
                $markers[] = [floatval($item->latitude), floatval($item->longitude), $i++];
            }
        }
        
        return $markers;
    }
    
    /**
     * @param int|null $department_id
     *
     * @return array
     */
    public function getDepartmentItemsGroups($department_id = null)
    {
        if (!$department_id) {
            $department_id = $this->current_department ? $this->current_department['id'] : null;
        }
        
        $items_groups = DepartmentItem::where('department_id', $department_id)
            ->visible()
            ->positionSorted()
            ->get();
        
        return $items_groups->groupBy('type');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function _getDepartments()
    {
        return Department::with('shares')->visible()->get();
    }
    
    /**
     * @return array|mixed|null
     */
    private function _getLocation()
    {
        if ((request()->ajax() || request()->wantsJson()) && request('id', false)) {
            $department = Department::where('id', request('id'))->visible()->first();
            
            if (!$department) {
                return null;
            }
            
            return [
                'lon'         => round($department->longitude, 6),
                'lat'         => round($department->latitude, 6),
                'id'          => $department->id,
                'name'        => $department->name,
                'image'       => $department->image,
                'description' => $department->description,
                'phone'       => $department->phone,
                'email'       => $department->email,
                'address'     => $department->address,
                'default'     => false,
            ];
        }
        
        $location = GeoIP::getLocation();
        
        $longA = $location['lon'] * (M_PI / 180); // M_PI is a php constant
        $latA = $location['lat'] * (M_PI / 180);
        $distance = [];
        
        foreach ($this->departments as $department) {
            $longB = $department['longitude'] * (M_PI / 180);
            $latB = $department['latitude'] * (M_PI / 180);
            $subBA = bcsub($longB, $longA, 20);
            $cosLatA = cos($latA);
            $cosLatB = cos($latB);
            $sinLatA = sin($latA);
            $sinLatB = sin($latB);
            
            $distance[] = [
                'distance' => 6371 * acos($cosLatA * $cosLatB * cos($subBA) + $sinLatA * $sinLatB),
                'params'   => [
                    'lon'         => round($department->longitude, 6),
                    'lat'         => round($department->latitude, 6),
                    'id'          => $department->id,
                    'name'        => $department->name,
                    'image'       => $department->image,
                    'description' => $department->description,
                    'phone'       => $department->phone,
                    'email'       => $department->email,
                    'address'     => $department->address,
                    'default'     => false,
                ],
            ];
        }
        
        $result = min($distance);
        
        if (((int) $result['distance']) > 100) {
            return null;
        }
        
        return $result['params'];
    }
}