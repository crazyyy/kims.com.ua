@if (is_array($item))
    <div class="form-group">
        <div class="form-group @if ($errors->has('items.'.$type.'.'.$key.'.' .$id. '.'. $locale .'.address')) has-error @endif">
            {!! Form::text('items['.$type.']['.$key.'][' . $id . '][' . $locale. '][address]', $item[$locale]['address'], ['id' => 'items.'.$type.'.'.$key.'.' . $id . '.' . $locale. '.address', 'placeholder' => trans('labels.address'), 'class' => 'form-control input-sm']) !!}

            {!! $errors->first('items.'.$type.'.new.' .$id. '.address', '<p class="help-block error">:message</p>') !!}
        </div>

        <div class="form-group">
            {!! Form::text('items['.$type.']['.$key.'][' . $id . '][' . $locale. '][description]', $item[$locale]['description'], ['id' => 'items.'.$type.'.'.$key.'.' . $id . '.' . $locale. '.description', 'placeholder' => trans('labels.description'), 'class' => 'form-control input-sm']) !!}
        </div>

        <div class="form-group @if ($errors->has('items.'.$type.'.'.$key.'.' .$id. '.'. $locale .'.work_schedule')) has-error @endif">
            {!! Form::textarea('items['.$type.']['.$key.'][' . $id . '][' . $locale. '][work_schedule]', $item[$locale]['work_schedule'], ['id' => 'items.'.$type.'.'.$key.'.' . $id . '.' . $locale. '.work_schedule', 'placeholder' => trans('labels.work_schedule'), 'rows' => 2, 'class' => 'form-control input-sm']) !!}

            {!! $errors->first('items.'.$type.'.new.' .$id. '.work_schedule', '<p class="help-block error">:message</p>') !!}
        </div>
    </div>
@else
    <div class="form-group">
        <div class="form-group @if ($errors->has('items.'.$type.'.'.$key.'.' .$id. '.'. $locale .'.address')) has-error @endif">
            {!! Form::text('items['.$type.']['.$key.'][' . $id . '][' . $locale. '][address]', isset($item->translate($locale)->address) ? $item->translate($locale)->address : '', ['id' => 'items.'.$type.'.'.$key.'.' . $id . '.' . $locale. '.address', 'placeholder' => trans('labels.address'), 'class' => 'form-control input-sm']) !!}

            {!! $errors->first('items.'.$type.'.new.' .$id. '.address', '<p class="help-block error">:message</p>') !!}
        </div>

        <div class="form-group">
            {!! Form::text('items['.$type.']['.$key.'][' . $id . '][' . $locale. '][description]', isset($item->translate($locale)->description) ? $item->translate($locale)->description: '', ['id' => 'items.'.$type.'.'.$key.'.' . $id . '.' . $locale. '.description', 'placeholder' => trans('labels.description'), 'class' => 'form-control input-sm']) !!}
        </div>

        <div class="form-group @if ($errors->has('items.'.$type.'.'.$key.'.' .$id. '.'. $locale .'.work_schedule')) has-error @endif">
            {!! Form::textarea('items['.$type.']['.$key.'][' . $id . '][' . $locale. '][work_schedule]', isset($item->translate($locale)->work_schedule) ? $item->translate($locale)->work_schedule : '', ['id' => 'items.'.$type.'.'.$key.'.' . $id . '.' . $locale. '.work_schedule', 'placeholder' => trans('labels.work_schedule'), 'rows' => 2, 'class' => 'form-control input-sm']) !!}

            {!! $errors->first('items.new.' .$id. '.work_schedule', '<p class="help-block error">:message</p>') !!}
        </div>
    </div>
@endif