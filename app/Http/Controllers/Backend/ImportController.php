<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 11.12.16
 * Time: 23:13
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Import\ImportRequest;
use App\Services\ImportService;
use Exception;
use FlashMessages;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Meta;

/**
 * Class ImportController
 * @package App\Http\Controllers\Backend
 */
class ImportController extends BackendController
{
    
    /**
     * @var string
     */
    public $module = "import";
    
    /**
     * @var array
     */
    public $accessMap = [
        'index'  => 'import.write',
        'import' => 'import.write',
    ];
    
    /**
     * @var \App\Services\ImportService
     */
    private $importService;
    
    
    /**
     * ImportController constructor.
     *
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     * @param \App\Services\ImportService                   $importService
     */
    public function __construct(ResponseFactory $response, ImportService $importService)
    {
        parent::__construct($response);
        
        $this->importService = $importService;
    
        Meta::title(trans('labels.import'));
    
        $this->breadcrumbs(trans('labels.import'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->data('page_title', trans('labels.import'));
        
        return $this->render($this->module.'.index');
    }
    
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $file = $request->file('price_file', null);
        
        if (empty($file)) {
            FlashMessages::add('error', trans('messages.you do not select the file'));
            
            return redirect()->back();
        }
        
        try {
            $this->importService->import($file);
            
            $errors = $this->importService->getErrors();
            
            $this->data('import_success', true);
            $this->data('import_errors', $errors);

            $this->data('page_title', trans('labels.import_results'));
            
            return $this->render($this->module.'.index');
        } catch (Exception $e) {
            FlashMessages::add('error', $e->getMessage());
    
            return redirect()->route('admin.'.$this->module.'.index');
        }
    }
}