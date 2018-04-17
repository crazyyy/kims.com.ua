<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Department\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use App\Traits\Controllers\AjaxFieldsChangerTrait;
use Datatables;
use DB;
use Exception;
use FlashMessages;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Meta;
use Redirect;
use Response;

/**
 * Class DepartmentController
 * @package App\Http\Controllers\Backend
 */
class DepartmentController extends BackendController
{
    
    use AjaxFieldsChangerTrait;
    
    /**
     * @var string
     */
    public $module = "department";
    
    /**
     * @var array
     */
    public $accessMap = [
        'index'           => 'department.read',
        'show'            => 'department.read',
        'create'          => 'department.create',
        'store'           => 'department.create',
        'edit'            => 'department.read',
        'update'          => 'department.write',
        'destroy'         => 'department.delete',
        'ajaxFieldChange' => 'department.write',
    ];
    
    /**
     * @var \App\Services\DepartmentService
     */
    private $departmentService;
    
    /**
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     * @param \App\Services\DepartmentService               $departmentService
     */
    public function __construct(ResponseFactory $response, DepartmentService $departmentService)
    {
        parent::__construct($response);
    
        $this->departmentService = $departmentService;
        
        Meta::title(trans('labels.departments'));
    
        $this->breadcrumbs(trans('labels.departments'), route('admin.'.$this->module.'.index'));
    }
    
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return $this
     */
    public function index(Request $request)
    {
        if ($request->get('draw')) {
            $list = Department::with('translations')
                ->joinTranslations('departments')
                ->select(
                    'departments.id',
                    'department_translations.name',
                    'department_translations.address',
                    'status'
                );
            
            return $dataTables = Datatables::of($list)
                ->filterColumn('id', 'where', 'departments.id', '=', '$1')
                ->filterColumn('name', 'where', 'department_translations.name', 'LIKE', '%$1%')
                ->filterColumn('address', 'where', 'department_translations.address', 'LIKE', '%$1%')
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
                ->make();
        }
        
        $this->data('page_title', trans('labels.departments'));
        $this->breadcrumbs(trans('labels.departments_list'));
        
        return $this->render('views.'.$this->module.'.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data('model', new Department());
        
        $this->data('page_title', trans('labels.department_creating'));
        
        $this->breadcrumbs(trans('labels.department_creating'));
        
        return $this->render('views.'.$this->module.'.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Department\DepartmentRequest $request
     *
     * @return \Response
     */
    public function store(DepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $model = new Department($request->all());
            $model->save();
            
            $this->departmentService->saveRelationships($model, $request);
            
            DB::commit();
            
            FlashMessages::add('success', trans('messages.save_ok'));
            
            return Redirect::route('admin.'.$this->module.'.index');
        } catch (Exception $e) {
            DB::rollBack();
            
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
            $model = Department::with('translations', 'items')->whereId($id)->firstOrFail();
            
            $this->data('page_title', '"'.$model->name.'"');
            
            $this->breadcrumbs(trans('labels.department_editing'));
            
            return $this->render('views.'.$this->module.'.edit', compact('model'));
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));
            
            return Redirect::route('admin.'.$this->module.'.index');
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int                                                    $id
     * @param \App\Http\Requests\Backend\Department\DepartmentRequest $request
     *
     * @return \Response
     */
    public function update($id, DepartmentRequest $request)
    {
        try {
            $model = Department::findOrFail($id);
            
            DB::beginTransaction();
            
            $model->fill($request->all());
            $model->save();
            
            $this->departmentService->saveRelationships($model, $request);
            
            DB::commit();
            
            return Redirect::route('admin.'.$this->module.'.index');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            
            FlashMessages::add('error', trans('messages.record_not_found'));
            
            return Redirect::route('admin.'.$this->module.'.index');
        } catch (Exception $e) {
            DB::rollBack();
            
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
            $model = Department::findOrFail($id);
            
            $model->delete();
            
            FlashMessages::add('success', trans('messages.destroy_ok'));
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));
        } catch (Exception $e) {
            FlashMessages::add('error', trans('messages.destroy_error'));
        }
        
        return Redirect::route('admin.'.$this->module.'.index');
    }
}
