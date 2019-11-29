@extends('layouts.app')

@section('title')
    {{ trans('global.login') }}
@endsection

@section('stylesheet')

@endsection

@section('navbar')
<style>
    body
    {
        background: rgba(255,129,137,1);
    }
    .card-login .form
    {
        min-height: 350px !important;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 ml-auto mr-auto card-login">
                    <div class="card card-login">
                        <form class="form" id="form-inicio-sesion" method="POST" action="{{ route('login') }}">
                            <div class="card-header card-header-primary text-center">
                                <h6 class="h3 text-uppercase">{{ trans('global.login') }}</h6>
                                @php
                                    $_lang = session()->get('lang');;
                                @endphp
                                @if($_lang == 'en')
                                    <a href="{{ route('change_lang', ['lang' => 'es']) }}" class="btn btn-white btn-link float-left" style="bottom: 15px;">
                                        <img src="{{ asset('icons/es.svg') }}" alt="" class="material-icons" width="35px">
                                    </a>
                                @elseif($_lang == 'es')
                                    <a href="{{ route('change_lang', ['lang' => 'en']) }}" class="btn btn-white btn-link float-left" style="bottom: 15px;">
                                        <img src="{{ asset('icons/en.svg') }}" alt="" class="material-icons" width="35px">
                                    </a>
                                @else

                                @endif
                                <span class="text-white text-uppercase" style="font-size: 12px;">
                                    {{ trans('global.o') }}
                                </span>
                                <a href="{{ route('register') }}" class="text-white text-uppercase mr-auto ml-auto" style="font-size: 12px;">
                                    {{ trans('global.register') }}
                                </a>
                            </div>
                            <p class="description text-center">TOKENS PALM ERA</p>
                                <div class="card-body">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">person</i>
                                            </span>
                                        </div>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="{{ trans('global.email') }}" autocomplete="of" autofocus="on" required="on" {{-- pattern="[A-Za-z]+@palmera.marketing" --}} data-toggle="tooltip" data-placement="top" title="{{ trans('global.loginInfo') }}">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('global.password') }}" autocomplete="on"  required="on">
                                    </div>
                                </div>
                                <div class=" text-center">
                                    <button type="submit" onclick="login()" class="btn btn-primary btn-link btn-lg">{{ trans('global.login') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function login()
    {
        var userName = document.getElementById('email');
        if (userName.value.substr(-18) == "@palmera.marketing")
        {
            //
        }
        else
        {   
            //
            var name = userName.value;
            userName.value += "@palmera.marketing";
            userName.style.color = "white";
        }
    }
</script>

@endsection
