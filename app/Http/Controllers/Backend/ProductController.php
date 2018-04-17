<?php namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Department;
use App\Models\Product;
use App\Traits\Controllers\AjaxFieldsChangerTrait;
use App\Traits\Controllers\ProcessMediaTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Datatables;
use FlashMessages;
use DB;
use Illuminate\Http\Request;
use Meta;
use Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Requests\Backend\Product\ProductRequest;

/**
 * Class ProductController
 * @package App\Http\Controllers\Backend
 */
class ProductController extends BackendController
{

    use AjaxFieldsChangerTrait;
    use ProcessMediaTrait;

    /**
     * @var string
     */
    public $module = "product";

    /**
     * @var array
     */
    public $accessMap = [
        'index'           => 'product.read',
        'show'            => 'product.read',
        'create'          => 'product.create',
        'store'           => 'product.create',
        'edit'            => 'product.read',
        'update'          => 'product.write',
        'destroy'         => 'product.delete',
        'ajaxFieldChange' => 'product.write',
    ];

    /**
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     */
    public function __construct(ResponseFactory $response)
    {
        parent::__construct($response);

        Meta::title(trans('labels.products'));

        $this->breadcrumbs(trans('labels.products'), route('admin.product.index'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        if ($request->get('draw')) {
            $list = Product::with('translations', 'category')
                ->joinTranslations('products')
                ->select(
                    'products.id',
                    'product_translations.name',
                    'category_id',
                    'status',
                    'position'
                );
            
            return $dataTables = Datatables::of($list)
                ->filterColumn('name', 'where', 'product_translations.name', 'LIKE', '%$1%')
                ->editColumn(
                    'category_id',
                    function ($model) {
                        return empty($model->category_id) ? '' : $model->category->name;
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
                ->removeColumn('translations')
                ->removeColumn('category')
                ->removeColumn('price')
                ->make();
        }

        $this->data('page_title', trans('labels.products'));
        $this->breadcrumbs(trans('labels.products_list'));

        return $this->render('views.'.$this->module.'.index');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->_fillAdditionTemplateData();

        $this->data('model', new Product());

        $this->data('page_title', trans('labels.product_creating'));

        $this->breadcrumbs(trans('labels.product_creating'));
        
        $this->_fillAdditionTemplateData();

        return $this->render('views.'.$this->module.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Product\ProductRequest $request
     *
     * @return \App\Http\Controllers\Backend\ProductController|\Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            $model = new Product($request->all());
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
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
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
            $model = Product::with('translations', 'category')->whereId($id)->firstOrFail();

            $this->data('page_title', '"'.$model->name.'"');

            $this->breadcrumbs(trans('labels.product_editing'));

            $this->_fillAdditionTemplateData();

            return $this->render('views.'.$this->module.'.edit', compact('model'));
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));

            return Redirect::route('admin.'.$this->module.'.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int                                              $id
     * @param \App\Http\Requests\Backend\Product\ProductRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ProductRequest $request)
    {

        try {
            $model = Product::findOrFail($id);

            $model->fill($request->all());
            $model->save();

            FlashMessages::add('success', trans('messages.save_ok'));

            return Redirect::route('admin.'.$this->module.'.index');
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));

            return Redirect::route('admin.product.index');
        } catch (Exception $e) {
            DB::rollBack();
            
            FlashMessages::add("error", trans('messages.update_error'));

            return Redirect::back()->withInput();
        }
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $model = Product::findOrFail($id);

            if (!$model->delete()) {
                FlashMessages::add("error", trans("messages.destroy_error"));
            } else {
                FlashMessages::add('success', trans("messages.destroy_ok"));
            }
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));
        }

        return Redirect::route('admin.'.$this->module.'.index');
    }

    /**
     * set to template addition variables for add\update product
     */
    private function _fillAdditionTemplateData()
    {
        $categories = ['' => trans('labels.please_select')];
        foreach (Category::with('translations')->get() as $category) {
            $categories[$category->id] = $category->name.' ('.$category->id.')';
        }
        $this->data('categories', $categories);
        
        $this->data('departments', Department::all());
    }
}
