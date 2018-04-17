<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 29.08.15
 * Time: 15:53
 */

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Page;
use App\Models\Share;
use App\Services\PageService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Response;
use View;

/**
 * Class PageController
 * @package App\Http\Controllers\Frontend
 */
class PageController extends FrontendController
{
    
    /**
     * @var string
     */
    public $module = 'page';
    
    /**
     * @var \App\Services\PageService
     */
    protected $pageService;
    
    /**
     * PageController constructor.
     *
     * @param \App\Services\PageService $pageService
     */
    public function __construct(PageService $pageService)
    {
        
        parent::__construct();
        
        $this->pageService = $pageService;
    }
    
    /**
     * @return $this
     */
    public function getHome()
    {
        $model = Page::withTranslations()->whereSlug('home')->first();
        
        abort_if(!$model, 404);
        
        $this->data('model', $model);
        
        $categories = $this->_getCategories($this->current_department);
        
        $this->data('categories', $categories);
        
        $this->fillMeta($model, $this->module);
        
        return $this->render('home');
    }
    
    /**
     * @return $this|\App\Http\Controllers\Frontend\PageController
     */
    public function getPage()
    {
        $slug = func_get_args();
        $slug = array_pop($slug);
        
        if ($slug == 'home') {
            return redirect(route('home'), 301);
        }
        
        $model = Page::with(['translations', 'parent', 'parent.translations'])->visible()->whereSlug($slug)->first();
        
        abort_if(!$model, 404);
        
        $this->data('model', $model);
        
        $this->fillMeta($model, $this->module);
        
        return $this->render($this->pageService->getPageTemplate($model));
    }
    
    /**
     * @return \Illuminate\Http\Response
     */
    public function notFound()
    {
        $view = View::make('errors.404')->render();
        
        return Response::make($view, 404);
    }
    
    
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function ajaxReloadPrices(Request $request)
    {
        if ($request->has('id')) {
            try {
                $categories = $this->_getCategories();
                
                $share = Share::with('translations')
                    ->where('department_id', $request->get('id'))
                    ->where('status', true)
                    ->first();
                
                $share = isset($share->image) && is_file(public_path().$share->image) ? $share->image : null;
                
                return [
                    'html'                         =>
                        view(
                            'partials.services_prices',
                            [
                                'categories'         => $categories,
                                'current_department' => $this->current_department,
                            ]
                        )->render(),
                    'share'                        => $share,
                    'promo_button'                 => view('partials.promo_button')->render(),
                    'department'                   => $this->current_department,
                    'current_department_latitude'  => $this->current_department ?
                        $this->current_department['lat'] :
                        null,
                    'current_department_longitude' => $this->current_department ?
                        $this->current_department['lon'] :
                        null,
                    'contact_tabs'                 => view(
                        'partials.contacts_popup_tabs',
                        [
                            'department_items_groups' => $this->current_department_items_groups,
                        ]
                    )->render(),
                    'contact_markers'              => $this->getContactMapMarkers(),
                ];
            } catch (Exception $e) {
            }
        }
        
        return [];
    }
    
    /**
     * @return \Illuminate\Support\Collection
     */
    private function _getCategories()
    {
        if (!$this->current_department) {
            return collect();
        }
        
        $categories = Category::with(
            [
                'translations',
                'products' => function ($query) {
                    return $query->joinTranslations()
                        ->whereRaw('product_translations.price LIKE \'%"'.$this->current_department['id'].'":%\'')
                        ->where('products.status', true)
                        ->select(
                            [
                                "products.id",
                                "products.category_id",
                                "products.position",
                                "products.status",
                            ]
                        );
                },
            ]
        )
            ->joinDepartmentCategories()
            ->where(
                function ($query) {
                    $query->whereExists(
                        function ($query) {
                            $query->select(DB::raw(1))
                                ->from('department_categories')
                                ->whereRaw('department_categories.category_id = categories.id');
                        }
                    )
                        ->where('department_categories.department_id', $this->current_department['id'])
                        ->where('department_categories.status', true);
                }
            )
            ->orWhere('categories.level', 0)
            ->visible()
            ->orderBy('department_categories.position', 'ASC')
            ->get(
                [
                    "categories.id",
                    "categories.parent_id",
                    "department_categories.position",
                    "categories.level",
                ]
            );
        
        return $categories;
    }
}