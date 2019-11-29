@extends('layouts.app')

@section('title')
    {{ trans('global.register') }}
@endsection

@section('stylesheet')
@endsection

@section('navbar')
<style>
    body
    {
        background: rgba(255,129,137,1);
    }
    .card-login .form {
        min-height: 350px !important;
    }
    
</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="">
                <div class="col-lg-5 col-md-5 ml-auto mr-auto" style="padding: 0px;">
                    <div class="card">
                        <form class="form" id="registerForm" name="registerForm" method="POST" action="{{ route('user.store') }}">
                            <div class="card-header card-header-primary text-center h">
                                <h6 class="h3 text-uppercase">{{ trans('global.register') }}</h6>
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
                                <a href="{{ route('login') }}" class="text-white text-uppercase" style="font-size: 12px;">
                                    {{ trans('global.login') }}
                                </a>
                                
                            </div>
                            <div class="card-body" style="padding: 15px 30px 15px 10px;">            
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                                    <input type="text" name="name" id="name" class="form-control" pattern="[A-Za-záÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.name') }}" style="" required="on">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">person</i>
                                        </span>
                                    </div>
                                    <input type="text" name="last_name" id="last_name" class="form-control" pattern="[A-Za-záÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.lastName') }}" style="margin-left: 0px;" required="on">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">mail</i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ trans('global.email') }}" value="" required="on" pattern="[A-Za-z]+@palmera.marketing" title="Debe ser una dirección de correo de Palm Era">
                                
                                
                                <input type="hidden" name="type" value="1">
                                
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">group_work</i>
                                        </span>
                                    </div>
                                    <select class="form-control" name="department">
                                        <option selected disabled value="">
                                            {{ trans('global.department') }}
                                        </option>
                                        @php 
                                            use App\Department;
                                            $departments = Department::get();
                                        @endphp
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->name }}
                                            </option>

                                        @endforeach
                                        
                                    </select>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('global.password') }}" style="" required="on" data-toggle="tooltip" data-placement="top" title="{{ trans('global.passwordInfo') }}">
                                    <button type="button" class="btn btn-sm btn-link" onclick=" cambiar();" style="color: #495057;"><i class="material-icons" id="changeV1">visibility</i></button>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                    </div>
                                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" placeholder="{{ trans('global.passwordC') }}" style="" required="on" data-toggle="tooltip" data-placement="bottom" title="{{ trans('global.confirmPasswordInfo') }}">
                                    <button type="button" class="btn btn-sm btn-link" onclick=" cambiar2();" style="color: #495057;"><i class="material-icons" id="changeV2">visibility</i></button>
                                </div>
                                
                                <div class=" text-center mr-auto ml-auto">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-lg btn-wd btn-link" id="changePasswordButton" data-toggle="modal" data-target="#modalRegisterConf" disabled>
                                        {{ trans('global.register') }}
                                    </button>


                                </div>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRegisterConf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-md-8 ml-auto mr-auto">
                <div class="modal-header">
                    <h6 class="h3 text-uppercase ml-auto mr-auto" id="exampleModalLabel">{{ trans('global.register') }}</h6>
                </div>
                <div class="modal-body text-center">
                    <p class="py-3">
                        {{ trans('global.signinConf') }}
                    </p>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary ml-auto mr-auto"  form="registerForm" name="registrar" value="{{ trans('global.register') }}" ></input>
                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="application/javascript">
    function cambiar()
    {
        var password = document.getElementById('password');
        var changeV1 = document.getElementById('changeV1');
        if (password.type == 'password')
        {
            password.type = 'text';
            changeV1.innerHTML = 'visibility_off';
        }
        else
        {
            password.type = 'password';
            changeV1.innerHTML = 'visibility';
        }
    }
    function cambiar2()
    {
        var passwordConfirm = document.getElementById('passwordConfirm');
        var changeV2 = document.getElementById('changeV2');

        if (passwordConfirm.type == 'password')
        {
            passwordConfirm.type = 'text';
            changeV2.innerHTML = 'visibility_off';
        }
        else
        {
            passwordConfirm.type = 'password';
            changeV2.innerHTML = 'visibility';
        }
    }
    function confirmPassword()
    {
        var passwordO = document.getElementById('password');
        var passwordC = document.getElementById('passwordConfirm');
        var passwordConfirm = document.getElementById('changePasswordButton');

        if (passwordO.value == passwordC.value && passwordO.value.length >= 8)
        {
            passwordConfirm.removeAttribute('disabled');
        }
        else
        {
            passwordConfirm.setAttribute('disabled', 'on');
        }
    }
    setInterval("confirmPassword()", 5);
</script>

@endsection

