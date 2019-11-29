@extends('layouts.app')

@section('title')
    {{ trans('global.login') }}
@endsection

@section('stylesheet')

@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <style>
        body
        {
            background: rgba(255,129,137,1);
        }
    </style>
    <div class="page-header">
        <div class="container text-center" style="padding-top: 1.5rem;">
            <h1>{{ trans('global.inventory') }}</h1>
        </div>
    </div>

    <div class="text-center py-5" style="padding: 0px;" name="anchorPoint" id="anchorPoint">
        

    </div>
@endsection

@section('script')

@endsection
