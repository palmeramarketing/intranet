@extends('layouts.app')

@section('title')
    {{ trans('Slider') }}
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
            <h1>{{ trans('Slider') }}</h1>
        </div>
    </div>
@endsection

@section('script')

@endsection