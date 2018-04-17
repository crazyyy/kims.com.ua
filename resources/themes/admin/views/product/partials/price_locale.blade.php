<table class="table table-bordered">
    <tbody>
    <tr>
        <th class="text-center">@lang('labels.department')</th>
        <th class="text-center">@lang('labels.price') (@lang('labels.department_price_helper_text'))</th>
    </tr>

    @foreach($departments as $department)
        <tr>
            <td>
                <div class="margin-top-5">
                    {!! $department->name !!}
                </div>
            </td>
            <td class="text-center">
                <div class="form-group required @if ($errors->has($locale.'.price.'.$department->id)) has-error @endif">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-xs-push-0 col-sm-push-3 col-md-push-4">
                        <input type="text"
                               class="form-control input-sm text-center"
                               name="{!! $locale !!}[price][{!! $department->id !!}]"
                               id="{!! $locale !!}_price_{!! $department->id !!}"
                               required="required"
                               value="{!! old($locale.'.price.'.$department->id) ?: $model->priceForDepartment($department->id, $locale) !!}">
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>