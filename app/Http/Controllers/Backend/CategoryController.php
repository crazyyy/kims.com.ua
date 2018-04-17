<?php namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Traits\Controllers\AjaxFieldsChangerTrait;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Datatables;
use Illuminate\Http\Request;
use FlashMessages;
use Meta;
use Response;
use Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Requests\Backend\Category\CategoryRequest;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Backend
 */
class CategoryController extends BackendController
{
    
    use AjaxFieldsChangerTrait;
    
    /**
     * @var string
     */
    public $module = "category";
    
    /**
     * @var array
     */
    public $accessMap = [
        'index'           => 'category.read',
        'show'            => 'category.read',
        'create'          => 'category.create',
        'store'           => 'category.create',
        'edit'            => 'category.read',
        'update'          => 'category.write',
        'destroy'         => 'category.delete',
        'ajaxFieldChange' => 'category.write',
    ];
    
    /**
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     */
    public function __construct(ResponseFactory $response)
    {
        
        parent::__construct($response);
        
        Meta::title(trans('labels.categories'));
        
        $this->breadcrumbs(trans('labels.categories'), route('admin.'.$this->module.'.index'));
    }
    
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Bllim\Datatables\json|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        
        if ($request->get('draw')) {
            $list = Category::with('parent', 'translations')
                ->joinTranslations('categories')
                ->select(
                    'categories.id',
                    'categories.image',
                    'category_translations.name',
                    'parent_id',
                    'status',
                    'position'
                );
            
            return $dataTables = Datatables::of($list)
                ->filterColumn('id', 'where', 'categories.id', '=', '$1')
                ->filterColumn('name', 'where', 'category_translations.name', 'LIKE', '%$1%')
                ->editColumn(
                    'image',
                    function ($model) {
                        return view('partials.datatables.image', ['src' => $model->image])->render();
                    }
                )
                ->editColumn(
                    'parent_id',
                    function ($model) {
                        return empty($model->parent) ? '' : $model->parent->name;
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
                    'position',
                    function ($model) {
                        return view(
                            'partials.datatables.text_input',
                            ['model' => $model, 'type' => $this->module, 'field' => 'position']
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
                ->removeColumn('meta_keywords')
                ->removeColumn('meta_title')
                ->removeColumn('meta_description')
                ->removeColumn('parent')
                ->removeColumn('translations')
                ->removeColumn('slug')
                ->make();
        }

        $this->data('page_title', trans('labels.categories'));
        $this->breadcrumbs(trans('labels.categories_list'));

        return $this->render('views.'.$this->module.'.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->_fillAdditionTemplateData();

        $this->data('model', new Category());

        $this->data('page_title', trans('labels.category_creating'));

        $this->breadcrumbs(trans('labels.category_creating'));

        return $this->render('views.'.$this->module.'.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Category\CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        $input['parent_id'] = isset($input['parent_id']) ? $input['parent_id'] : null;

        try {
            $model = new Category($input);
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
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
            $model = Category::with('translations', 'parent')->whereId($id)->firstOrFail();

            $this->data('page_title', '"'.$model->name.'"');

            $this->breadcrumbs(trans('labels.category_editing'));

            $this->_fillAdditionTemplateData($model);

            return $this->render('views.'.$this->module.'.edit', compact('model'));
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));
            
            return Redirect::route('admin.'.$this->module.'.index');
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int                                                $id
     * @param \App\Http\Requests\Backend\Category\CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CategoryRequest $request)
    {
        try {
            $model = Category::findOrFail($id);

            $input = $request->all();
            $input['parent_id'] = isset($input['parent_id']) ? $input['parent_id'] : null;

            $model->fill($input);

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $model = Category::findOrFail($id);
            
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
     * @param Category|null $model
     */
    private function _fillAdditionTemplateData($model = null)
    {
        $list = Category::with('translations')->visible();
        $parents = ['' => trans('labels.please_select')];
        if ($model) {
            $list = $list->where('id', '<>', $model->id);
        }
        foreach ($list->get() as $item) {
            $parents[$item->id] = $item->name;
        }
        $this->data('parents', $parents);

        $levels = array(
            trans('labels.level-0'),
            trans('labels.level-1'),
            trans('labels.level-2')
        );
        $this->data('levels', $levels);
    }
}
