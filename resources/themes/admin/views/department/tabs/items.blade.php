<div class="box-body table-responsive no-padding">
    <table class="table table-hover duplication">
        <tbody>
        <tr>
            <th class="col-sm-5">{!! trans('labels.description') !!}</th>
            <th class="col-sm-2">{!! trans('labels.phones') !!}</th>
            <th class="col-sm-2">{!! trans('labels.coordinates') !!}</th>
            <th class="col-sm-1">{!! trans('labels.status') !!}<span class="required">*</span></th>
            <th class="col-sm-1">{!! trans('labels.position') !!}<span class="required">*</span></th>
            <th class="col-sm-1">{!! trans('labels.delete') !!}</th>
        </tr>

        @php($items = $model->items->where('type', $type))

        @if (count($items))
            @foreach($items as $item)
                <tr class="duplication-row">
                    <td class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @foreach (config('app.locales') as $key => $locale)
                                <li @if ($key == 0) class="active" @endif>
                                    <a aria-expanded="false" href="#tab_item_{!! $type !!}_locale_old_{!! $locale !!}_{!! $item->id !!}" data-toggle="tab">
                                        <i class="flag flag-{!! $locale !!}"></i>
                                        @lang('labels.tab_'.$locale)
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach (config('app.locales') as $key => $locale)
                                <div class="tab-pane fade in @if ($key == 0) active @endif" id="tab_item_{!! $type !!}_locale_old_{!! $locale !!}_{!! $item->id !!}">
                                    @include('views.department.partials.item_locale', ['id' => $item->id, 'key' => 'old'])
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="form-group required @if ($errors->has('items.'.$type.'.old.' .$item->id. '.phones')) has-error @endif">
                            {!! Form::textarea('items['.$type.'][old][' .$item->id. '][phones]', $item->phones, ['id' => 'items.'.$type.'.old.' .$item->id. '.phones', 'class' => 'form-control input-sm']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group required @if ($errors->has('items.'.$type.'.old.' .$item->id. '.latitude')) has-error @endif">
                            {!! Form::text('items['.$type.'][old][' .$item->id. '][latitude]', $item->latitude, ['id' => 'items.'.$type.'.old.' .$item->id. '.latitude', 'class' => 'form-control input-sm']) !!}
                        </div>
                        <div class="form-group required @if ($errors->has('items.'.$type.'.old.' .$item->id. '.longitude')) has-error @endif">
                            {!! Form::text('items['.$type.'][old][' .$item->id. '][longitude]', $item->longitude, ['id' => 'items.'.$type.'.old.' .$item->id. '.longitude', 'class' => 'form-control input-sm']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group required @if ($errors->has('items.'.$type.'.old.' .$item->id. '.status')) has-error @endif">
                            {!! Form::select('items['.$type.'][old][' .$item->id. '][status]', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], $item->status, ['id' => 'items.'.$type.'.old.' .$item->id. '.position', 'class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]) !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group required @if ($errors->has('items.'.$type.'.old.' .$item->id. '.position')) has-error @endif">
                            {!! Form::text('items['.$type.'][old][' .$item->id. '][position]', $item->position, ['id' => 'items.'.$type.'.old.' .$item->id. '.position', 'class' => 'form-control input-sm']) !!}
                        </div>
                    </td>
                    <td class="coll-actions">
                        <a class="btn btn-flat btn-danger btn-xs action exist destroy" data-id="{!! $item->id !!}" data-name="items[{!! $type !!}][remove][]"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif

        @if (count(old('items.'.$type.'.new')))
            @foreach(old('items.'.$type.'.new') as $item_key => $item)
                @if ($item_key !== 'replaseme')
                    <tr class="duplication-row">
                        <td class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                @foreach (config('app.locales') as $key => $locale)
                                    <li @if ($key == 0) class="active" @endif>
                                        <a aria-expanded="false" href="#tab_item_{!! $type !!}_locale_new_{!! $locale !!}_{!! $item_key !!}" data-toggle="tab">
                                            <i class="flag flag-{!! $locale !!}"></i>
                                            @lang('labels.tab_'.$locale)
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach (config('app.locales') as $key => $locale)
                                    <div class="tab-pane fade in @if ($key == 0) active @endif" id="tab_item_{!! $type !!}_locale_new_{!! $locale !!}_{!! $item_key !!}">
                                        @include('views.department.partials.item_locale', ['id' => $item_key, 'key' => 'new'])
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="form-group required @if ($errors->has('items.'.$type.'.new.' .$item_key. '.phones')) has-error @endif">
                                {!! Form::textarea('items['.$type.'][new][' .$item_key. '][phones]', $item['phones'], ['id' => 'items.'.$type.'.new.' .$item_key. '.phones', 'class' => 'form-control input-sm']) !!}
                            </div>
                        </td>
                        <td>
                            <div class="form-group required @if ($errors->has('items.'.$type.'.new.' .$item_key. '.latitude')) has-error @endif">
                                {!! Form::text('items['.$type.'][new][' .$item_key. '][latitude]', $item['latitude'], ['id' => 'items.'.$type.'.new.' .$item_key. '.latitude', 'class' => 'form-control input-sm']) !!}
                            </div>
                            <div class="form-group required @if ($errors->has('items.'.$type.'.new.' .$item_key. '.longitude')) has-error @endif">
                                {!! Form::text('items['.$type.'][new][' .$item_key. '][longitude]', $item['longitude'], ['id' => 'items.'.$type.'.new.' .$item_key. '.longitude', 'class' => 'form-control input-sm']) !!}
                            </div>
                        </td>
                        <td>
                            <div class="form-group required @if ($errors->has('items.'.$type.'.new.' .$item_key. '.status')) has-error @endif">
                                {!! Form::select('items['.$type.'][new][' .$item_key. '][status]', ['1' => trans('labels.status_on'), '0' => trans('labels.status_off')], $item['status'], ['id' => 'items.'.$type.'.new.' .$item_key. '.status', 'class' => 'form-control select2 input-sm', 'aria-hidden' => 'true', 'required' => true]) !!}
                            </div>
                        </td>
                        <td>
                            <div class="form-group required @if ($errors->has('items.'.$type.'.new.' .$item_key. '.position')) has-error @endif">
                                {!! Form::text('items['.$type.'][new][' .$item_key. '][position]', $item['position'], ['id' => 'items.'.$type.'.new.' .$item_key. '.position', 'class' => 'form-control input-sm']) !!}
                            </div>
                        </td>
                        <td class="coll-actions">
                            <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif

        <tr class="duplication-button">
            <td colspan="6" class="text-center">
                <a title="@lang('labels.add_one_more')" class="btn btn-flat btn-primary btn-sm action create"><i class="glyphicon glyphicon-plus"></i></a>
            </td>
        </tr>

        <tr class="duplication-row duplicate">
            <td class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @foreach (config('app.locales') as $key => $locale)
                        <li @if ($key == 0) class="active" @endif>
                            <a aria-expanded="false" href="#tab_item_{!! $type !!}_locale_new_{!! $locale !!}_replaseme" data-toggle="tab">
                                <i class="flag flag-{!! $locale !!}"></i>
                                @lang('labels.tab_'.$locale)
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach (config('app.locales') as $key => $locale)
                        <div class="tab-pane fade in @if ($key == 0) active @endif" id="tab_item_{!! $type !!}_locale_new_{!! $locale !!}_replaseme">
                            <div class="form-group required">
                                <input data-name="items[{!! $type !!}][new][replaseme][{!! $locale !!}][address]" placeholder="@lang('labels.address')" class="form-control input-sm">
                            </div>

                            <div class="form-group required">
                                <input data-name="items[{!! $type !!}][new][replaseme][{!! $locale !!}][description]" placeholder="@lang('labels.description')" class="form-control input-sm">
                            </div>

                            <div>
                                <textarea data-name="items[{!! $type !!}][new][replaseme][{!! $locale !!}][work_schedule]" placeholder="@lang('labels.work_schedule')" rows="2" class="form-control input-sm"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </td>
            <td>
                <div class="form-group required">
                    <textarea data-name="items[{!! $type !!}][new][replaseme][phones]" data-required="required" rows="2" class="form-control input-sm"></textarea>
                </div>
            </td>
            <td>
                <div class="form-group required">
                    <input data-name="items[{!! $type !!}][new][replaseme][latitude]" value="" data-required="required" class="form-control input-sm">
                </div>
                <div class="form-group required">
                    <input data-name="items[{!! $type !!}][new][replaseme][longitude]" value="" data-required="required" class="form-control input-sm">
                </div>
            </td>
            <td>
                <div class="form-group required">
                    <select class="form-control select2 input-sm" data-required="required" aria-hidden="true" data-name="items[{!! $type !!}][new][replaseme][status]">
                        <option selected="selected" value="1">@lang('labels.status_on')</option>
                        <option value="0">@lang('labels.status_off')</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group required">
                    <input data-name="items[{!! $type !!}][new][replaseme][position]" value="0" data-required="required" class="form-control input-sm">
                </div>
            </td>
            <td class="coll-actions">
                <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fa fa-remove"></i></a>
            </td>
        </tr>

        </tbody>
    </table>
</div>