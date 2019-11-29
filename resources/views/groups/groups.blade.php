@extends('layouts.app')

@section('title')
    {{ trans('global.groups') }}
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
            background-color: #7FB2A5;
        }       
    </style>

    
    <div class="page-header" style="padding-top: 6rem;">
        <div class="container text-center" style="padding-top: 1.5rem;">
            <div class="card card col-md-5 f-p-m" style="display: inline-block" >
                <form class="form" id="registerForm" name="registerForm" method="POST" action="{{ route('groupCreate') }}">
                    <div class="card-header card-header-primary text-center h">
                        <h6 class="h3 text-uppercase">{{ trans('global.groups') }}</h6>
                    </div>
                    <div class="card-body" style="padding: 15px 30px 15px 10px;">
                                    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">group_work</i>
                                </span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control" pattern="[A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.name') }}" style="" required="on">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">person</i>
                                </span>
                            </div>
                            <select name="admin" id="admin" class="form-control" required="on">
                                <option selected="on" disabled value="" id="adminN">
                                    {{ trans('global.admin') }}
                                </option> 
                                @foreach($users as $user)
                                    @if( $user->type != 3)
                                        <option value="{{ $user->id }}" id="adminN{{ $user->id }}">
                                            {{ $user->name." ".$user->last_name }}
                                        </option>
                                    @else
                                    @endif

                                @endforeach
                            </select>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">people</i>
                                    </span>
                                </div>
                                <select name="users[]" multiple="multiple" id="multi" rows="4" class="form-control selectpicker" data-style="btn btn-link" required="on">
                                    <option selected="on" disabled value="">
                                        {{ trans('global.users') }}
                                    </option> 
                                    @foreach($users as $user)
                                        @if( $user->type)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name." ".$user->last_name }}
                                            </option>
                                        @else
                                        @endif

                                    @endforeach
                                </select>
                                <script>
                                    $('#multi').fSelect();
                                </script>
                            </div>
                        </div>
                        <div class=" text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-link btn-wd btn-lg" id="registerG" data-toggle="modal" data-target="#modalRegisterGroup">
                                {{ trans('global.registerUser') }}
                            </button>

                            <!-- Modal -->
                            
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="modalRegisterGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content col-md-8 ml-auto mr-auto">
                        <div class="modal-header">
                            <h6 class="h3 text-uppercase ml-auto mr-auto" style="color: #000;">{{ trans('global.groups') }}</h6>  
                        </div>
                        <div class="modal-body">
                            <span class="h3" id="nameC" style="color: #000;"></span>
                                <br>
                            <span class="h5 text-muted" id="adminC" style="color: #000;"></span>
                                <br>
                            
                            <p class="py-3" style="color: #000;">{{ trans('global.registerGroupConf') }}</p>
                            <script>
                                function registerConf()
                                {
                                    //
                                    var name = document.getElementById('name'),
                                        admin = document.getElementById('admin'),
                                        nameC = document.getElementById('nameC'),
                                        adminC = document.getElementById('adminC');

                                    nameC.innerHTML = name.value;
                                    var adminID = document.getElementById('adminN'+admin.value);

                                    adminC.innerHTML = adminID.innerText;


                                }
                                var registerG = document.getElementById('registerG');
                                registerG.addEventListener('click', registerConf);
                            </script>
                
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary ml-auto mr-auto" form="registerForm" name="registrar" value="{{ trans('global.registerUser') }}"></input>
                            <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>



    <div class="text-center py-3" style="padding: 0px;" name="anchorPoint" id="anchorPoint">
        @if($groups->count())  
            @foreach($groups as $group)
                        <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px; height: 350px;">
                            <div class="card" style="width: 275px; display: inline-block; margin: 0px">
                                <div class="front" style="height: 350px;">
                                    {{-- <div class="card-img-top" style="width: 275px; height: 232px; background-image: url('{{ asset('uploads/'.$product->img) }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                    </div> --}}
                                    {{-- <h4 class="card-title h4">{{ $product->name }}</h4> --}}
                                    
                                    <div class="card-body">
                                        <h4 class="card-text h4 text-uppercase" style="height: 54px;">{{ $group->name }}</h4>
                                    </div>
                                    <div class="card-footer" style="position: absolute; bottom: 0px; left: 20%;">
                                        <button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
                                            {{ trans('global.more') }}
                                        </button>
                                    </div>
                                </div>
                                {{-- 
                                    Ajustar el diseño
                                 --}}
                                <div class="back" style="height: 350px;">
                                    <div class="card-body" style="vertical-align: middle;">
                                        <button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; right: 9.25px; top: 5.47px;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="card-text h4 text-uppercase" style="display: inline-block;">{{ trans('global.edit') }}</h4>
                                        <form action="{{ route('groupUpdate', $group->id) }}" class="form py-3" role="form" method="POST">

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
                                                        <i class="material-icons">group_work</i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="name" value="{{ $group->name }}">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="admin" >
                                                    <option disabled>
                                                        {{ trans('global.admin') }}
                                                    </option>
                                                    @foreach($users as $user)
                                                        @if($user->type != 3)
                                                            @if($user->id == $group->admin)
                                                                <option selected value="{{ $user->id }}">
                                                                    {{ $user->name." ".$user->last_name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name." ".$user->last_name }}
                                                                </option>
                                                            @endif
                                                            
                                                        @else
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
                                                        <i class="material-icons">people</i>
                                                    </span>
                                                </div>
                                                <select name="users[]" multiple="multiple" id="multi-{{ $group->id }}" rows="4" class="form-control selectpicker" data-style="btn btn-link" required="on">
                                                    @php
                                                        $groupsUsers = explode('","', substr($group->users, 2, strlen($group->users)-4));
                                                    @endphp 
                                                    @foreach($users as $user)
                                                        {{-- @foreach( as $userX) --}}
                                                            @if(in_array($user->id, $groupsUsers))
                                                                <option selected value="{{ $user->id }}">
                                                                    {{ $user->name." ".$user->last_name }} 
                                                                </option>
                                                            @else
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name." ".$user->last_name }}
                                                                </option>
                                                            
                                                            @endif
                                                        {{-- @endforeach --}}
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                            <div class=" text-center" style="position: absolute; bottom: 15px; left: 20px;">
                                                <button type="button" class="btn btn-success btn-round btn-fab btn-sm" data-toggle="modal" data-target="#modalEdit-{{ $group->id }}">
                                                    <i class="material-icons">refresh</i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEdit-{{ $group->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">
                                                    <div class="modal-dialog" role="document" style="margin: 0px;">
                                                        <div class="modal-content" style="width: 275px; height: 360px;">
                                                            <div class="modal-header">
                                                        
                                                      </div>
                                                      <div class="modal-body">
                                                            {{ trans('global.updateConf').$group->name }}
                                                      </div>
                                                      <div class="modal-footer text-center">
                                                            <input type="submit" class="btn btn-success mr-auto ml-auto" name="actualizar" value="{{ trans('global.update') }}"></input>
                                                            <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>

                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </form>
                                    </div>
                                    
                                    {{--<a class="btn btn-sm btn-danger btn-fab btn-round" href="https://palmera.marketing/tokens/BankAndDepDel/{{ $group->id }}" style="position: fixed; right: 20px; bottom: 20px;">
                                        <i class="material-icons">delete</i>
                                    </a>--}}
                                    <button type="button" class="btn btn-danger btn-fab btn-round btn-sm text-center" data-toggle="modal" data-target="#exampleModal2-{{ $group->id }}" style="position: fixed; right: 20px; margin-right: 15px; bottom: 20px;">
                                        <span class="glyphicon glyphicon-trash">
                                            <i class="material-icons">delete</i>
                                        </span>
                                    </button>
                                    <div class="modal fade text-center" id="exampleModal2-{{ $group->id }}" tabindex="3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">
                                        <div class="modal-dialog" role="document" style="margin: 0px;">
                                            <div class="modal-content" style="width: 275px; height: 360px";>
                                                <div class="modal-body">
                                                    <div class="text-center ">
                                                    </div>
                                                    <p class="py-5">{{ trans('global.deleteConf').$group->name }}?</p>
                                                </div>
                                                <div class="modal-footer text-center">
                                                    <a class="btn btn-danger btn-wd btn-md ml-auto mr-auto" href="{{ route('groupsDel', $group->id) }}" style="">
                                                       {{ trans('global.delete') }}
                                                    </a>
                                                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            </div>
                        </div>
                    

                
                
                
            @endforeach 
        @else
        @endif
    </div>
    {{ $groups->links() }}
@endsection

@section('script')
<style type="text/css" media="screen">
    .modal-backdrop
    {
        z-index: -3;
    }       
    .card-container, .front, .back
    {
        height: 360px;
    }
</style>
@foreach($groups as $group)
    <script>
        $('#multi-{{ $group->id }}').fSelect();
    </script>
@endforeach

@endsection
