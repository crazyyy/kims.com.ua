<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Share\ShareRequest;
use App\Models\Department;
use App\Models\Share;
use App\Traits\Controllers\AjaxFieldsChangerTrait;
use Datatables;
use Exception;
use FlashMessages;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Meta;
use Redirect;
use Response;

/**
 * Class ShareController
 * @package App\Http\Controllers\Backend
 */
class ShareController extends BackendController
{
    
    use AjaxFieldsChangerTrait;
    
    /**
     * @var string
     */
    public $module = "share";
    
    /**
     * @var array
     */
    public $accessMap = [
        'index'           => 'share.read',
        'show'            => 'share.read',
        'create'          => 'share.create',
        'store'           => 'share.create',
        'edit'            => 'share.read',
        'update'          => 'share.write',
        'destroy'         => 'share.delete',
        'ajaxFieldChange' => 'share.write',
    ];
    
    
    /**
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     */
    public function __construct(ResponseFactory $response)
    {
        
        parent::__construct($response);
        
        Meta::title(trans('labels.shares'));
        
        $this->breadcrumbs(trans('labels.shares'), route('admin.'.$this->module.'.index'));
    }
    
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return $this
     */
    public function index(Request $request)
    {
        
        if ($request->get('draw')) {
            $list = Share::with('translations', 'department')
                ->joinTranslations('shares')
                ->select(
                    'shares.id',
                    'share_translations.name',
                    'shares.department_id',
                    'status'
                );
            
            return $dataTables = Datatables::of($list)
                ->filterColumn('id', 'where', 'shares.id', '=', '$1')
                ->filterColumn('name', 'where', 'share_translations.name', 'LIKE', '%$1%')
                ->editColumn(
                    'image',
                    function ($model) {
                        return view('partials.datatables.image', ['src' => $model->image])->render();
                    }
                )
                ->editColumn(
                    'status',
                    function ($model) {
                        return view(
                            'partials.datatables.toggler',
                            ['model' => $model, 'type' => $this->module, 'field' => 'status']
                        )->render();
                    }
                )
                ->editColumn(
                    'department_id',
                    function ($model) {
                        return $model->getDepartmentName();
                    }
                )
                ->editColumn(
                    'actions',
                    function ($model) {
                        return view(
                            'partials.datatables.control_buttons',
                            ['model' => $model, 'type' => $this->module]
                        )->render();
                    }
                )
                ->setIndexColumn('id')
                ->removeColumn('description')
                ->removeColumn('translations')
                ->removeColumn('department')
                ->make();
        }
        
        $this->data('page_title', trans('labels.shares'));
        $this->breadcrumbs(trans('labels.shares_list'));
        
        return $this->render('views.'.$this->module.'.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data('model', new Share());
        
        $this->data('page_title', trans('labels.share_creating'));
        
        $this->breadcrumbs(trans('labels.share_creating'));
        
        $this->_fillAdditionalTemplateData();
        
        return $this->render('views.'.$this->module.'.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Share\ShareRequest $request
     *
     * @return \Response
     */
    public function store(ShareRequest $request)
    {
        try {
            $model = new Share($request->all());
            $model->save();
            
            FlashMessages::add('success', trans('messages.save_ok'));
            
            return Redirect::route('admin.'.$this->module.'.index');
        } catch (Exception $e) {
            FlashMessages::add('error', trans('messages.save_failed'));
            
            return Redirect::back()->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $model = Share::with('translations')->whereId($id)->firstOrFail();
            
            $this->data('page_title', '"'.$model->name.'"');
            
            $this->breadcrumbs(trans('labels.share_editing'));
    
            $this->_fillAdditionalTemplateData();
            
            return $this->render('views.'.$this->module.'.edit', compact('model'));
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));
            
            return Redirect::route('admin.'.$this->module.'.index');
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int                                          $id
     * @param \App\Http\Requests\Backend\Share\ShareRequest $request
     *
     * @return \Response
     */
    public function update($id, ShareRequest $request)
    {
        try {
            $model = Share::findOrFail($id);
            
            $model->fill($request->all());
            $model->save();
            
            return Redirect::route('admin.'.$this->module.'.index');
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));
            
            return Redirect::route('admin.'.$this->module.'.index');
        } catch (Exception $e) {
            FlashMessages::add('error', trans('messages.saving_failed'));
            
            return Redirect::back()->withInput();
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $model = Share::findOrFail($id);
            
            $model->delete();
            
            FlashMessages::add('success', trans('messages.destroy_ok'));
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));
        } catch (Exception $e) {
            FlashMessages::add('error', trans('messages.destroy_error'));
        }
        
        return Redirect::route('admin.'.$this->module.'.index');
    }
    
    /**
     * fill additional template data
     */
    private function _fillAdditionalTemplateData()
    {
        $departments = ['' => trans('labels.please_select')];
        foreach (Department::with('translations')->get() as $department) {
            $departments[$department->id] = $department->name;
        }
        $this->data('departments', $departments);
    }
}
