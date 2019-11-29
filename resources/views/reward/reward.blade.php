@extends('layouts.app')

@section('title')
	{{ trans('global.reward') }}
@endsection

@section('stylesheet')

@endsection

@section('navbar')
	@include('layouts.navbar')
@endsection

@php
	use App\User;
	use App\Bank;
	use App\RewardHistory;
	$users = User::get();
	$bank = Bank::where('id_admin', Auth::user()->id)->first();
@endphp

@section('content')
<style>
	body
	{
		background-color: #79E2DB;
	}
	.modal-backdrop {
        z-index: -3;
    }
</style>
<div class="page-header" {{-- style="height: 80vh;" --}}>        
    <div class="container text-center" style="padding-top: 1.5rem;">
        <div class="card card col-md-5" style="display: inline-block">
		    <form class="form" id="payForm" name="payForm" method="POST" action="@if(Auth::user()->type == 3)
	                                                                    {{ route('payReward') }}
		                                                            @else
		                                                                {{ route('requestReward') }}
		                                                            @endif" enctype="multipart/form-data">
		        <div class="card-header card-header-primary text-center h">
		            <h6 class="h3 text-uppercase">{{ trans('global.reward') }}</h6>
		        </div>
		        <div class="card-body" style="padding: 15px 30px 15px 10px;">
		            <div class="input-group">
		                <input type="hidden" name="from" id="from" value="{{ Auth::user()->id }}">
		                {{-- <input type="hidden" name="from" id="from" value="{{ Auth::user()->id }}"> --}}
		            </div>
		            <div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">person</i>
		                    </span>
		                </div>
		                <select name="to" id="name" class="form-control" required>
		                    <option disabled selected value="" id="nameN">
								{{ trans('global.user') }}
		                    </option>
		                    @if(Auth::user()->type == 3)
    		                	@foreach($users as $user)
    		                		@if( $user->id != Auth::user()->id)
    			                		<option value="{{ $user->id }}" id="nameN{{ $user->id }}">
    			                			{{ $user->name." ".$user->last_name }}
    			                		</option>
    			                	@else
    			                	@endif
    		                	@endforeach
    		                @elseif(Auth::user()->type == 2)
    		                    @foreach($users as $user)
    		                    	@if(Auth::user()->department == $user->department)
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
		            <div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
			                	<img src="{{ asset('icons/tokens.svg') }}" id="" alt="" width="24">
			                </span>
		                </div>
		                <input type="number" name="amount" id="amount" class="form-control" pattern="[0-9]{1,10}" placeholder="{{ trans('global.amount') }}" required="on">
		            </div>
		            <div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">description</i>
		                    </span>
		                </div>
		                <textarea name="description" id="description" cols="20" rows="2" class="form-control" maxlength="500" placeholder="{{ trans('global.reason') }}" required="on"></textarea>
		            </div>
		            <div class=" text-center">
			            <button type="button" class="btn btn-primary btn-link btn-wd btn-lg" id="payBtn" data-toggle="modal" data-target="#modalReward">
			            	@if(Auth::user()->type == 3)
                                {{ trans('global.pay') }}
                            @else
                                {{ trans('global.request') }}
                            @endif							  
						</button>
		            </div>
		        </div>
		    </form>
		</div>
    </div>
</div>

<div class="modal fade" id="modalReward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content col-md-8 ml-auto mr-auto">
	    	<div class="modal-header">
        		<h6 class="h3 text-uppercase ml-auto mr-auto" style="color: #000;">{{ trans('global.reward') }}</h6>  
	    	</div>
		    <div class="modal-body text-center">
		    	<span class="h4" id="nameC" style="color: #000;"></span>
                    <br>
                    <br>
                <p class="card-text" style="vertical-align: middle;">
                    <img src="{{ asset('icons/tokens.svg') }}" width="19px" style="margin: -10px 5px 0px 0px;">
                    <span id="amountC" class="h4" style="color: #000;"></span>
			    </p>


		        <p class="py-3">{{ trans('global.rewardConf') }}</p>
		        <script>
                	function payInfo()
                	{
                		//
                		var name = document.getElementById('name'),
                			amount = document.getElementById('amount'),
                			nameC = document.getElementById('nameC'),
                			amountC = document.getElementById('amountC');

                		// nameC.innerHTML = name.value;
                		amountC.innerHTML = amount.value;

                		var userID = document.getElementById('nameN'+name.value);
                		nameC.innerHTML = userID.innerText;


                	}
                	var payBtn = document.getElementById('payBtn');
                	payBtn.addEventListener('click', payInfo);
                </script>
		    </div>
		    <div class="modal-footer text-center">
		      	<input type="submit" form="payForm" id="pay" class="btn btn-primary ml-auto mr-auto" name="payReward" value="
        																									@if(Auth::user()->type == 3)
											                                                                    {{ trans('global.pay') }}
												                                                            @else
												                                                                {{ trans('global.request') }}
												                                                            @endif">
        		<button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>

		    </div>
	    </div>
	</div>
</div>

<div class="text-center py-4" name="anchorPoint" id="anchorPoint">
	@foreach($rewards as $reward)
	    @if(Auth::user()->id == $reward->from_admin)
	    <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px;">
			<div class="card" style="width: 275px; display: inline-block; margin: 0px">
				<div class="front">
					<div class="card-body">
					    @foreach($users as $user)
					        @if($user->id == $reward->to_user)
						        <h4 class="card-text h4 text-uppercase">{{ $user->name }}</h4>
                                <span class="h4 text-uppercase">{{ $user->last_name }}</span>
					        @else

					        @endif
				        @endforeach
            			<div class="py-5" style="vertical-aling: middle">
            			    <span style="">
                                <img src="{{ asset('icons/tokens.svg') }}" id="" alt="" width="21" style="margin-top: -3px;">
                            </span>
            				<span class="card-text text.muted h4 text-uppercase py-5" style="vertical-align: middle;">
	                			{{ $reward->amount }}
	                		</span>
	                	</div>
					</div>
					<div class="card-footer" style="position: absolute; bottom: 0px; left: 18%;">
					 	<button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
						 	{{ trans('global.details') }}
						</button>
					</div>
				</div>
				{{-- 
					...
				 --}}
				<div class="back">
					<div class="card-body" style="vertical-align: middle;">
						<button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; right: 9.25px; top: 5.47px;">
	      					<span aria-hidden="true">&times;</span>
	    				</button>
					 	<h4 class="card-text h4 text-uppercase" style="display: inline-block;">{{ trans('global.reason') }}</h4>
					 	<div class="text-center mr-auto ml-auto" style="">
					        <span class="mr-auto ml-auto" style="">{{ $reward->created_at }}</span>
					    </div>
					 	<div class="force-scroll-p contenedor-p" style="height: 190px;">
            				<span class="card-text text.muted h4 text-uppercase">
                    			{{ $reward->description }}
                    		</span>
                    	</div>
					</div>
					
				</div>
			</div>
		</div>
	    @else

	    @endif
    @endforeach

    
</div>
{{ $rewards->links() }}
@endsection

@section('script')
<style>
    .card-container, .front, .back
	{
	    height: 360px;
	}
</style>
<script>
	function validatePay()
	{
		var sendPay = document.getElementById('pay');
		var bank = "{{ $bank->amount }}";
		var amountPay = document.getElementById('amount').value;

		if (parseInt(bank) < parseInt(amountPay))
		{
			sendPay.setAttribute('disabled', 'on');
		}
		else
		{
			sendPay.removeAttribute('disabled');
		}
	}
	setInterval("validatePay()", 50);
</script>

@endsection