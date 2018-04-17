<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 29.08.15
 * Time: 15:53
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Contaminant\ContaminantRequest;
use App\Models\Contaminant;
use App\Models\Share;
use App\Models\User;
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
 * Class ContaminantController
 * @package App\Http\Controllers\Backend
 */
class ContaminantController extends BackendController
{

    use AjaxFieldsChangerTrait;

    /**
     * @var string
     */
    public $module = "contaminant";

    /**
     * @var array
     */
    public $accessMap = [
        'index'           => 'contaminant.read',
        'create'          => 'contaminant.create',
        'store'           => 'contaminant.create',
        'show'            => 'contaminant.read',
        'edit'            => 'contaminant.read',
        'update'          => 'contaminant.write',
        'destroy'         => 'contaminant.delete',
        'ajaxFieldChange' => 'contaminant.write',
    ];

    /**
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     */
    public function __construct(ResponseFactory $response)
    {
        parent::__construct($response);

        Meta::title(trans('labels.contaminants'));

        $this->breadcrumbs(trans('labels.contaminants'), route('admin.'.$this->module.'.index'));
    }

    /**
     * Display a listing of the resource.
     * GET /contaminant
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Response
     */
    public function index(Request $request)
    {
        if ($request->get('draw')) {
            $list = Contaminant::with('translations')->joinTranslations(
                'contaminants',
                'contaminant_translations'
            )->select(
                'contaminants.id',
                'contaminant_translations.name',
                'class',
                'status',
                'default'
            );

            return $dataTables = Datatables::of($list)
                ->filterColumn('id', 'where', 'contaminants.id', '=', '$1')
                ->filterColumn('name', 'where', 'contaminant_translations.name', 'LIKE', '%$1%')
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
                    'default',
                    function ($model) {
                        return view(
                            'partials.datatables.icon_status',
                            ['model' => $model, 'type' => $this->module, 'field' => 'default', 'only_true' => true]
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

        $this->data('page_title', trans('labels.contaminants'));
        $this->breadcrumbs(trans('labels.contaminants_list'));

        return $this->render('views.'.$this->module.'.index');
    }

    /**
     * Show the form for creating a new resource.
     * GET /contaminant/create
     *
     * @return Response
     */
    public function create()
    {
        $this->_fillAdditionalTemplateData();

        $this->data('model', new Contaminant);

        $this->data('page_title', trans('labels.contaminant_creating'));

        $this->breadcrumbs(trans('labels.contaminant_creating'));

        return $this->render('views.'.$this->module.'.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /contaminant
     *
     * @param ContaminantRequest $request
     *
     * @return \Response
     */
    public function store(ContaminantRequest $request)
    {
        $input = $request->all();

        try {
            $model = new Contaminant($input);
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
     * GET /contaminant/{id}
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
     * GET /contaminant/{id}/edit
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $model = Contaminant::with('translations')->whereId($id)->firstOrFail();

            $this->data('page_title', '"'.$model->name.'"');

            $this->breadcrumbs(trans('labels.contaminant_editing'));

            $this->_fillAdditionalTemplateData();

            return $this->render('views.'.$this->module.'.edit', compact('model'));
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));

            return Redirect::route('admin.'.$this->module.'.index');
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT /contaminant/{id}
     *
     * @param  int               $id
     * @param ContaminantRequest $request
     *
     * @return \Response
     */
    public function update($id, ContaminantRequest $request)
    {
        try {
            $model = Contaminant::whereId($id)->firstOrFail();

            $model->fill($request->all());
            $model->save();

            DB::commit();

            FlashMessages::add('success', trans('messages.save_ok'));

            return Redirect::route('admin.'.$this->module.'.index');
        } catch (ModelNotFoundException $e) {
            FlashMessages::add('error', trans('messages.record_not_found'));

            return Redirect::route('admin.'.$this->module.'.index');
        } catch (Exception $e) {
            DB::rollBack();

            FlashMessages::add("error", trans('messages.update_error'));

            return Redirect::back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /contaminant/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $model = Contaminant::findOrFail($id);

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
     * fill additional template data
     */
    private function _fillAdditionalTemplateData()
    {
        $shares = ['' => trans('labels.not_set')];
        foreach (Share::with('translations')->get() as $share) {
            $shares[$share->id] = $share->name;
        }
        $this->data('shares', $shares);
    }
}