@extends('layouts.editable')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($model, ['role' => 'form', 'method' => 'put', 'class' => 'form-horizontal', 'route' => ['admin.department.update', $model->id]]) !!}

            @include('views.department.partials._form')

            {!! Form::close() !!}
        </div>
    </div>

@stop