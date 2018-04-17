@extends('emails.master')

@section('content')
    <div>@lang('front_messages.admin email message about new feedback')</div>

    <br>
	<div><b>@lang('labels.city'):</b> {!! $city !!}</div>
    <div><b>@lang('labels.user'):</b> {!! $fio !!}</div>
    <div><b>@lang('labels.phone'):</b> {!! $phone !!}</div>
    <div><b>@lang('labels.email'):</b> {!! $email !!}</div>
    <div><b>@lang('labels.message'):</b> {!! $user_message !!}</div>

@stop