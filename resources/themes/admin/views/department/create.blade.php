@extends('layouts.editable')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => 'admin.department.store', 'role' => 'form', 'class' => 'form-horizontal']) !!}

            @include('views.department.partials._form')

            {!! Form::close() !!}
        </div>
    </div>
@stop