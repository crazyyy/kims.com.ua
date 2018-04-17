<div class="form-group required @if ($errors->has($locale.'.image')) has-error @endif">
    {!! Form::label($locale . '[image]', trans('labels.image'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']) !!}

    <div class="col-xs-12 col-sm-7 col-md-10">
        {!! Form::imageInput($locale.'[image]', isset($model->translate($locale)->image) ? $model->translate($locale)->image : null) !!}

        {!! $errors->first($locale.'.image', '<p class="help-block error">:message</p>') !!}
    </div>
</div>

<div class="form-group required @if ($errors->has($locale.'.name')) has-error @endif">
    {!! Form::label($locale . '[name]', trans('labels.name'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']) !!}

    <div class="col-xs-12 col-sm-7 col-md-10">
        {!! Form::text($locale.'[name]', isset($model->translate($locale)->name) ? $model->translate($locale)->name : '', ['placeholder'=> trans('labels.name'), 'required' => true, 'class' => 'form-control input-sm name_'.$locale]) !!}

        {!! $errors->first($locale.'.name', '<p class="help-block error">:message</p>') !!}
    </div>
</div>

<div class="form-group @if ($errors->has($locale . '[description]')) has-error @endif">
    {!! Form::label($locale . '[description]', trans('labels.description'), ['class' => 'control-label col-xs-4 col-sm-3 col-md-2']) !!}

    <div class="col-xs-8 col-sm-7 col-md-10">
        {!! Form::textarea($locale . '[description]', isset($model->translate($locale)->description) ? $model->translate($locale)->description : '', ['rows' => '3', 'placeholder' => trans('labels.description'), 'class' => 'form-control input-sm content_' . $locale]) !!}

        {!! $errors->first($locale . '[description]', '<p class="help-block error">:message</p>') !!}
    </div>
</div>
@include('partials.tabs.ckeditor', ['id' => $locale . '[description]'])