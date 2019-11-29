@extends('layouts.app')

@section('title')
    {{ trans('global.evaluate') }}
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <style>
        
    </style>
    <div class="" style="width: 100vw; height: 100vh;"> 
        <div class="container text-center py-5" style="">
            <div class="card card col-md-5" style="display: inline-block; margin-top: 5rem;">
                <form class="form" id="evaluateForm" name="evaluateForm" method="POST" action="{{ route('evaluation') }}">
                    {{--<div class="card-header card-header-primary text-center h">
                        <h6 class="h3 text-uppercase">{{ trans('global.evaluation') }}</h6>
                    </div>--}}
                    <h6 class="h3 text-uppercase ml-auto mr-auto" id="exampleModalLabel">{{ trans('global.evaluation') }}</h6>            

                    <div class="card-body" style="padding: 20px 30px 10px 10px;">
                        <div class="input-group">
                            <input type="hidden" name="id_evaluator" id="from" value="{{ Auth::user()->id }}">
                            {{-- <input type="hidden" name="from" id="from" value="{{ Auth::user()->id }}"> --}}
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="padding-left: 0px;">
                                    <i class="material-icons">person</i>
                                </span>
                            </div>
                            <select name="id_user" class="form-control" required>
                                <option disabled selected value="">
                                    {{ trans('global.user') }}
                                </option>
                                @if(Auth::user()->type == 3)
                                    @foreach($users as $user)
                                        @if( $user->id != Auth::user()->id && $user->evaluated == 0 && $user->type == 2)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name." ".$user->last_name }}
                                            </option>
                                        @else
                                        @endif
                                    @endforeach
                                @elseif(Auth::user()->type == 2)
                                    @foreach($users as $user)
                                        @if(Auth::user()->department == $user->department && $user->evaluated == 0)
                                            @if(Auth::user()->id == $user->id)
                                            @else
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name." ".$user->last_name }}
                                                </option>
                                            @endif
                                        @else
                                        @endif
                                    @endforeach
                              @else
                              @endif
                            </select>
                        </div>
                        @foreach($questions as $question)
                            @if($question->state != 1)

                            @elseif($question->state == 1)
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="padding-left: 0px;" data-toggle="tooltip" data-placement="right" data-html="true" title="<span class='text-uppercase'>{{ $question->question }}</span><br>{{ $question->description }}">
                                            <i class="material-icons">{{ $question->icon }}</i>
                                        </span>
                                    </div>
                                    <input type="range" name="question{{ $question->id }}" id="question-{{ $question->id }}" class="form-control" value="5" min="1" max="10" step="1" required="on">
                                    <span class="font-weight-normal" id="valueQ-{{ $question->id }}"></span>
                                </div>
                            @else
                            @endif
                        @endforeach
                        <div class=" text-center">
                            <span  class="py-3 font-weight-bold" id="average" style="position: fixed; left: 30px; bottom: 5px;"></span>
                            <button type="button" class="btn btn-primary btn-link btn-wd btn-lg" data-toggle="modal" data-target="#modalEvaluate">
                                {{ trans('global.evaluate') }}
                            </button>

                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEvaluate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-md-8 ml-auto mr-auto">
                <div class="modal-header">
                    <h6 class="h3 text-uppercase ml-auto mr-auto" id="exampleModalLabel">{{ trans('global.evaluate') }}</h6>            
                </div>
                  <div class="modal-body text-center">
                    <p class="py-3">{{ trans('global.evaluateConf') }}</p>
                  </div>
                  <div class="modal-footer text-center">
                    <button type="submit" id="btn-eval" class="btn btn-primary ml-auto mr-auto" name="" form="evaluateForm">
                        {{ trans('global.evaluate') }}
                    </button>
                        <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                  </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @foreach($questions as $question)
        @if($question->state == 1)
            <script>
                function updateQ{{ $question->id }}()
                {
                    //
                    var input{{ $question->id }} = document.getElementById('question-{{ $question->id }}').value;
                    var showValue{{ $question->id }} = document.getElementById('valueQ-{{ $question->id }}');
                    showValue{{ $question->id }}.innerHTML = input{{ $question->id }};
                }
                setInterval("updateQ{{ $question->id }}()", 50);
            </script>
        @else
        @endif
    @endforeach
    <script>
        function updateAverage()
        {
            //
            var averageValue = 0;     
            var average = document.getElementById('average');
        @foreach($questions as $question)
            @if($question->state == 1)
                var qv{{ $question->id }} = document.getElementById('question-{{ $question->id }}').value;
            @else
            @endif
        @endforeach
        @foreach($questions as $question)
            @if($question->state == 1)
                averageValue += parseFloat(qv{{ $question->id }});
            @else
            @endif
        @endforeach
            average.innerHTML =  (averageValue/10).toFixed(2);
        }
        setInterval("updateAverage()", 50);
    </script>
@endsection