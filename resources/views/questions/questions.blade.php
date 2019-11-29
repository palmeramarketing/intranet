@extends('layouts.app')

@section('title')
	{{ trans('global.admin') }}
@endsection

@section('stylesheet')
	<style>
		body
		{
			background: #7FB2A5;
		}
        .card-container, .front, .back
        {
            height: 360px;
        }
        .modal-backdrop {
            z-index: -3;
        }
	</style>

@endsection

@php
    use App\Evaluation;
@endphp

@section('navbar')
	@include('layouts.navbar')
@endsection

@section('content')
    <div class="py-5" style="width: 100vw; height: 100vh;">
        <div class="container text-center py-5">
            <div class="card card col-md-5" style="display: inline-block" >
                <form class="form" method="POST" name="registerForm" id="registerForm" action="{{ route('question') }}" autocomplete="off">
                    <div class="card-header card-header-primary text-center h" style="z-index: 10000;">
                        <h6 class="h3 text-uppercase">{{ trans('global.questions') }}</h6>
                    </div>
                    <div class="card-body" style="padding: 15px 10px 15px 10px;">
                                    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">help</i>
                                </span>
                            </div>
                            <input type="text" name="question" id="question" class="form-control" pattern="[A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.question') }}" style="" required="on">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">description</i>
                                </span>
                            </div>
                            <textarea name="description" class="form-control" id="" cols="30" rows="3" placeholder="{{ trans('global.description') }}"></textarea>
                        </div>
                        
                        <div class="force-scroll-p contenedor-p ml-auto mr-auto" style="height: 120px; max-width: 100% !important; width: 350px; margin: 10px 0px;">
                            @foreach($icons as $icon)
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label" style="color: #495057;">
                                    <input class="form-check-input" type="radio" name="icon" id="inlineRadio1" value="{{ $icon->name }}"><i class="material-icons">{{ $icon->name }}</i>
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            @endforeach    
                        </div>
                        <div class=" text-center" style="padding: 15px 0px 0px 0px;">
                            <button type="submit" id="registerLM" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalregister">
                                {{ trans('global.registerUser') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="container text-center" id="anchorPoint" name="anchorPoint">

    @foreach($questions as $question)
        <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 0px;">
            <div class="card" style="width: 275px; display: inline-block; margin: 0px; height: 360px;">
                <div class="front">
                    
                    <div class="card-body" style="padding-top: 10px;">
                        <h4 class="card-text h4 text-uppercase" style="margin: 0px;">{{ $question->question }}</h4>
                        <p class="py-2">
                            {{ $question->description }}
                        </p>
                    </div>
                    <div class="card-footer" style="position: absolute; bottom: -10px; left: 20%;">
                        <button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
                            {{ trans('global.edit') }}
                        </button>
                    </div>
                </div>
                <div class="back">
                    <div class="card-body" style="vertical-align: middle;">
                        <h4 class="card-text h4 text-uppercase" style="display: inline-block;">{{ trans('global.edit') }}</h4>
                        <form class="form py-3" id="form-update-{{ $question->id }}" name="form-update-{{ $question->id }}" method="POST" action="" role="form">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="padding-left: 0px;">
                                            <i class="material-icons">help</i>
                                        </span>
                                    </div>
                                    <input type="text" name="question" id="question" class="form-control" pattern="[A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.question') }}" style="" required="on" value="{{ $question->question }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="padding-left: 0px;">
                                            <i class="material-icons">description</i>
                                        </span>
                                    </div>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="3" placeholder="{{ trans('global.description') }}">{{ $question->description }}</textarea>
                                </div>
                                
                                <div class="force-scroll-p contenedor-p" style="margin-top: 10px; height: 80px; max-width: 100% !important; width: 200px;">
                                    @foreach($icons as $icon)
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label" style="color: #495057;">
                                            <input class="form-check-input" type="radio" name="icon" id="inlineRadio1" value="{{ $icon->name }}"><i class="material-icons">{{ $icon->name }}</i>
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    @endforeach    
                                </div>                           
                                
                                <div class="card-footer" style="position: absolute; bottom: 0px; padding-left: 0px;">
                                    <button type="button" class="btn btn-success btn-fab btn-round btn-sm" data-toggle="modal" data-target="#exampleModal-{{ $question->id }}-{{ $question->id }}">
                                        <i class="material-icons">refresh</i>
                                    </button>
                                    <div class="modal fade" id="exampleModal-{{ $question->id }}-{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="margin: 0px;">
                                            <div class="modal-content" style="width: 275px; height: 360px;">
                                                <div class="modal-body">
                                                    <div class="text-center ">
                                                    </div>
                                                    <p class="py-5">{{ trans('global.updateConf').$question->name }}?</p>          
                                                </div>
                                                <div class="modal-footer text-center" style="height: 65px;">
                                                    <input type="submit" class="btn btn-success btn-md mr-auto ml-auto" name="actualizar" value="{{ trans('global.update')}}">
                                                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                    </div>
                    <button type="button" class="btn btn-warning btn-fab btn-round btn-sm" data-toggle="modal" data-target="#exampleModal2-{{ $question->id }}" style="position: fixed; right: 10px; margin-right: 20px; bottom: 15px;">
                        <span class="glyphicon glyphicon-trash">
                            <i class="material-icons">archive</i>
                        </span>
                    </button>
                    <div class="modal fade text-center" id="exampleModal2-{{ $question->id }}" tabindex="3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">
                    <div class="modal-dialog" role="document" style="margin: 0px;">
                        <div class="modal-content" style="width: 275px; height: 360px";>
                            <div class="modal-body">
                                <div class="text-center ">
                                </div>
                                <p class="py-5">{{ trans('global.deleteConf').$question->name." ".$question->last_name }}?</p>
                            </div>
                            <div class="modal-footer text-center">
                                <form class="form-inline text-center mr-auto ml-auto" action="" method="post">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger btn-wd btn-md ml-auto mr-auto " type="submit">
                                        {{ trans('global.delete') }}
                                    </button>

                                </form>
                                <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{ $questions->links() }}
    </div>


@endsection

@section('script')

@endsection