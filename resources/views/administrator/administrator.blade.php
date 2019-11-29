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
	<div class="page-header">
        <div class="container text-center">
            <div class="card col-md-3 ml-auto mr-auto" style="height: 200px;">
                <div class="continer">
                    <div class="card-body text-center">
                        <span class="h4 text-uppercase ml-auto mr-auto">
                            {{ trans('global.evaluations') }}
                        </span>
                    </div>
                    <div class="card-footer" style="position: fixed; bottom: 0px;">
                        <?php
                            try
                            {
                                //
                                Evaluation::get();
                        ?>
                            <form class="form-inline" method="GET" id="createEval" name="createEval" action="{{ route('createEvaluation') }}" style="display: inline-block; margin-right: 7px;">
                                <button type="button" class="btn btn-info btn-sm mr-auto ml-auto float-left" disabled data-toggle="tooltip" data-placement="top" title="Tooltip on top" style="margin-right: 7px;">{{ trans('global.start') }}</button>
                            </form>
                            <form class="form-inline" method="GET" id="deleteEval" name="deleteEval" action="{{ route('destroyEvaluation') }}" style="display: inline-block; margin-left: 7px;">
                                <button type="button" class="btn btn-danger btn-sm mr-auto ml-auto float-right" data-toggle="modal" data-target="#modalDelete" style="margin-left: 7px;">{{ trans('global.end') }}</button>
                            </form>
                        <?php 
                            }
                            catch (Exception $e)
                            {
                        ?>
                            <form class="form-inline" method="GET" id="createEval" name="createEval" action="{{ route('createEvaluation') }}" style="display: inline-block; margin-right: 7px;">
                                <button type="button" class="btn btn-info btn-sm mr-auto ml-auto float-left" data-toggle="modal" data-target="#modalCreate" style="margin-right: 7px;">{{ trans('global.start') }}</button>
                            </form>
                            <form class="form-inline" method="GET" id="deleteEval" name="deleteEval" action="{{ route('destroyEvaluation') }}" style="display: inline-block; margin-left: 7px;">
                                <button type="button" class="btn btn-danger btn-sm mr-auto ml-auto float-right" disabled data-toggle="tooltip" data-placement="top" title="Tooltip on top" style="margin-left: 7px;">{{ trans('global.end') }}</button>
                            </form>
                        <?php
                            }
                        ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-md-8 ml-auto mr-auto ml-auto">
                <div class="modal-header text-center">
                    <h6 class="h3 text-uppercase ml-auto mr-auto" style="color: #000;">{{ trans('global.evaluations') }}</h6>
                </div>
                <div class="modal-body text-center">
                    {{ trans('global.createEvalConf') }}
                </div>
                <div class="modal-footer">
                    <button type="submit" form="createEval" class="btn btn-info ml-auto mr-auto">{{ trans('global.start') }}</button>
                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-md-8 ml-auto mr-auto text-center">
                <div class="modal-header">
                    <h6 class="h3 text-uppercase ml-auto mr-auto" style="color: #000;">{{ trans('global.evaluations') }}</h6>
                </div>
                <div class="modal-body text-center">
                    {{ trans('global.deleteEvalConf') }}
                </div>
                <div class="modal-footer">
                    <button type="submit" form="deleteEval" class="btn btn-danger ml-auto mr-auto">{{ trans('global.end') }}</button>
                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container text-center">
        <span class="h1">
            @foreach($evaluations_historys as $evaluations_history)
                <span class="h4 mr-auto ml-auto">{{ $evaluations_history->date }}</span>


            @endforeach
        </span>
    </div>








{{-- 

    <div class="page-header">
        <div class="container text-center">
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
                        
                        <div class="force-scroll-p contenedor-p" style="height: 120px; max-width: 100% !important; width: 100%;">
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
        <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px;">
            <div class="card" style="width: 275px; display: inline-block; margin: 0px; height: 360px;">
                <div class="front">
                    
                    <div class="card-body" style="padding-top: 10px;">
                        <h4 class="card-text h4 text-uppercase" style="margin: 0px;">{{ $question->name }}</h4>
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
                                        <span class="input-group-text">
                                            <i class="material-icons">help</i>
                                        </span>
                                    </div>
                                    <input type="text" name="question" id="question" class="form-control" pattern="[A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.question') }}" style="" required="on" value="{{ $question->question }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">description</i>
                                        </span>
                                    </div>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="3" placeholder="{{ trans('global.description') }}">{{ $question->description }}</textarea>
                                </div>
                                
                                <div class="force-scroll-p contenedor-p" style="height: 80px; max-width: 100% !important; width: 100%;">
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
                                
                                <div class="card-footer" style="position: absolute; bottom: 0px;">
                                    <button type="button" class="btn btn-sm btn-info btn-fab btn-round" data-toggle="modal" data-target="#exampleModal-{{ $question->id."-".$question->id."-".$question->id }}" style="position: fixed; left: 5px; margin-left: 15px; bottom: 15px">
                                        <i class="material-icons">vpn_key</i>
                                    </button>
                                    <div class="modal fade" id="exampleModal-{{ $question->id."-".$question->id."-".$question->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="margin: 0px;">
                                            <div class="modal-content" style="width: 275px; height: 360px;">
                                                <div class="modal-body">
                                                    <p class="py-5">
                                                        {{ trans('global.passwordResConf').$question->name." ".$question->last_name }}?
                                                        {{ trans('global.newPassword') }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer text-center" style="height: 65px;">
                                                    <a class="btn btn-md btn-info ml-auto mr-auto" href="https://palmera.marketing/tokens/passwordReset/{{ $question->id }}">
                                                        {{ trans('global.reset') }}
                                                    </a>                                                    
                                                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    <button type="button" class="btn btn-danger btn-fab btn-round btn-sm" data-toggle="modal" data-target="#exampleModal2-{{ $question->id }}" style="position: fixed; right: 10px; margin-right: 15px; bottom: 15px;">
                        <span class="glyphicon glyphicon-trash">
                            <i class="material-icons">delete</i>
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
    </div> --}}


@endsection

@section('script')

@endsection