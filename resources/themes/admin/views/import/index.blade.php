@extends('layouts.editable')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                {!! Form::open(['route' => 'admin.import.import', 'class' => 'form', 'role' => 'form', 'enctype'=>'multipart/form-data', 'method' => 'post']) !!}

                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-push-4">
                            <div class="form-group text-center @if ($errors->has('price_file')) has-error @endif">
                                <h5>{!! Form::label('price_file', trans('labels.select_a_file'), ['class' => 'control-label col-sm-12 margin-bottom-20']) !!}</h5>

                                {!! Form::file('price_file', ['style' => 'margin: 0px auto; display: block;']) !!}

                                {!! $errors->first('price_file', '<p class="help-block error position-relative">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="col-sm-2 col-sm-push-5">
                        <div class="btn btn-block btn-flat btn-success with-loading">
                            @lang('labels.import')
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

            @if (isset($import_success))
                @if (empty($import_errors))
                    <div class="callout callout-success">
                        <p>@lang('messages.import success')</p>
                    </div>
                @else
                    <div class="callout callout-warning">
                        <p>@lang('messages.import loaded')</p>
                    </div>
                @endif
            @endif

            @if (!empty($import_errors))
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('labels.errors')</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="@lang('labels.collapse')" data-original-title="@lang('labels.collapse')">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="@lang('labels.hide')" data-original-title="@lang('labels.hide')">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                        @foreach($import_errors as $error)
                            <p class="help-block error position-relative">{!! $error !!}</p>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection