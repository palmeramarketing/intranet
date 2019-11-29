@extends('layouts.app')

@section('title')
    {{ trans('global.acount') }}
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
            background-color: #00A6CE;
        }
        .card-container, .front, .back
        {
            height: 450px;
        }
        .avatarUsers
        {
            width: 290px;
            height: 275px;
            background-image: url('{{ asset('public/avatar/'.Auth::user()->img) }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .modal-backdrop {
            z-index: -3;
        }
        .modal
        {
            padding-right: 0px !important;
        }
    </style>

<div class="page-header" style="padding-top: 1rem;">
    <div class="container text-center" style="padding-top: 1.5rem;">
        <div class="card-container manual-flip" style="width: 290px; display: inline-block; margin: 0px;">
            <div class="card" style="width: 290px; display: inline-block; margin: 0px">
                <div class="front">
                    {{-- 

                     --}}
                     <button type="button" class="close btn btn-round btn-fab btn-sm btn-danger" id="defaultBP" onclick="defaultPicture()" style="position: fixed; top: 2px; right: 7px; display: none;">
                        <i class="material-icons">clear</i>
                    </button>
                    <label for="file-upload" class="subir ">
                        <div for="file-upload" class="subir card-img-top avatarUsers" id="avatarUser" {{-- style="background-image: url('{{ asset('public/avatar/'.Auth::user()->img) }}');" --}}>
                            <form class="" method="POST" action="{{ route('imgUpdate') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="input-group">
                                    <span class="file-upload">
                                        <input type="file" id="file-upload" accept="image/*" name="img" class="form-control" style="display:none;" required>
                                    </span>
                                </div>

                                <div class=" text-center">
                                    <button type="submit" class="btn btn-info btn-sm btn-round btn-fab" name="registrar" value="" style="top: 230px; right: -115px;" data-toggle="tooltip" data-placement="top" title="{{ trans('global.picUpdate') }}">
                                        <i class="material-icons">publish</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </label>

                    {{-- 

                     --}}
                     
                     {{-- 

                      --}}
                    <div class="card-body" style="padding-top: 0px;">
                        <h4 class="card-text h4 text-uppercase text-truncate" style="max-height: 27px;">{{ Auth::user()->name }}</h4>
                        <p class="card-text" style="vertical-align: middle;">
                            <span class="h4">{{ Auth::user()->last_name }}</span>
                        </p>
                    </div>
                    <div class="card-footer text-center" style="position: absolute; bottom: 0px; left: 23%;">
                        <button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
                            {{ trans('global.more') }}
                        </button>
                    </div>
                </div>
                <div class="back">
                    <div class="card-body" style="vertical-align: middle;">
                        <button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; top: 2px; right: 7px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="card-text h4 text-uppercase text-truncate" style="max-height: 27px;">{{ Auth::user()->name }}</h4>
                        <p class="card-text " style="vertical-align: middle;">
                            <span class="h5">{{ Auth::user()->email }}</span>
                        </p>
                        <p class="card-text text-justify text-center" style="height: 150px; overflow-y: hidden" >
                            @foreach($departments as $department)
                                @if(Auth::user()->department == $department->id)
                                    <span class="h4">{{ $department->name}}</span>
                                @else
                                @endif
                            @endforeach
                        </p>
                        <form class="form" method="POST" action="{{ route('CP', Auth::user()->id) }}" role="form" style="padding: 16px 0px;">
                            {{ csrf_field() }}
                            <span class="h4 text-uppercase">
                                {{ trans('global.password') }}
                            </span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="padding: 0px 10px 0px 0px;">
                                        <i class="material-icons">vpn_key</i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password" maxlength="255" class="form-control" placeholder="{{ trans('global.passwordN') }}" required="on" data-toggle="tooltip" data-placement="top" title="{{ trans('global.passwordInfo') }}">
                                <button type="button" class="btn btn-sm btn-link" style="padding: 6.5px 0px 6.5px 10px; color: #495057;" onclick=" cambiar();"><i class="material-icons" id="changeV1">visibility</i></button>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="padding: 0px 10px 0px 0px;">
                                        <i class="material-icons">vpn_key</i>
                                    </span>
                                </div>
                                <input type="password" name="passwordConfirm" id="passwordConfirm" maxlength="255" class="form-control" placeholder="{{ trans('global.passwordC') }}" required="on" data-toggle="tooltip" data-placement="bottom" title="{{ trans('global.confirmPasswordInfo') }}">
                                <button type="button" class="btn btn-sm btn-link" style="padding: 6.5px 0px 6.5px 10px; color: #495057;" onclick=" cambiar2();"><i class="material-icons" id="changeV2">visibility</i></button>
                            </div>
                            <div class="text-center">
                                <span>
                                    

                                    <!-- Button trigger modal -->
                                    <button type="button" id="changePasswordButton" class="btn btn-warning btn-round btn-fab" data-toggle="modal" data-target="#exampleModal" disabled style="position: fixed; bottom: 10px; right: 10px;">
                                        <i class="material-icons">vpn_key</i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right: 0px !important;">
                                        <div class="modal-dialog" role="document" style="margin: 0px; ">
                                            <div class="modal-content" style="height: 450px;">
                                                <div class="modal-body">
                                                    
                                                    <div class="py-5">
                                                        <p class="py-5">
                                                            {{ trans('global.changePasswordConf') }}
                                                        </p>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <div class="modal-footer text-center">
                                                    <button type="submit" class="btn btn-warning mr-auto ml-auto" name="registrar" value="{{ trans('global.change') }}">
                                                        {{ trans('global.change') }}
                                                    </button>
                                                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="page-header text-center">
    <span class="display-1 ml-auto mr-auto">Estadisticas del individuo</span>
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
        
        function ImgPreview(upload)
        {
            if (upload.files && upload.files[0])
            {
                var reader = new FileReader();
                reader.onload = function (e)
                {
                    $('#avatarUser').attr('style', 'background-image: url('+e.target.result+')');
                }
                reader.readAsDataURL(upload.files[0]);
            }
        }
        $('#file-upload').change(function()
            {
                ImgPreview(this);
                var btnD = document.getElementById('defaultBP');
                btnD.style.display = 'inline';

            });
        $('#defaultBP').click(function ()
        {
            this.style.display = 'none';
            var defaultPic = document.getElementById('avatarUser');
            defaultPic.removeAttribute('style');
        });
    </script>

@endsection
