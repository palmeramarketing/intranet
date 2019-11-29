@extends('layouts.app')

@section('title')

	{{ trans('global.wallet') }}

@endsection

@php
	use App\Wallet;
	$wallet = Wallet::where('id_user', Auth::user()->id)->value('amount');
@endphp

@section('stylesheet')

	<style>

		body
		{
			background-color: #79E2DB;
		}
		.card-container, .front, .back
		{
		    height: 360px;
		}

	</style>

@endsection

@section('navbar')

	@include('layouts.navbar')

@endsection

@section('content')
<div class="page-header py-5">
    <div class="container text-center">
		<div class="card card col-md-5 f-p-m" style="display: inline-block">
		    <form class="form" id="payForm" name="payForm" method="POST" action="
    										{{ route('pay') }}
    										" enctype="multipart/form-data">
		        <div class="card-header card-header-primary text-center h">
		            <h6 class="text-uppercase h3">

	            		{{ trans('global.wallet') }}

	            	</h6>
		        </div>
		        <div class="card-body" style="padding: 15px 30px 15px 10px;">
		            <div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">person</i>
		                    </span>
		                </div>
		                <input type="hidden" name="from" value="
	                									{{ Auth::user()->id }}
	                									">
		                <select name="to" id="name" class="form-control" required="on">
		                    <option selected="on" disabled value="" id="nameN">

		                    	{{ trans('global.user') }}

		                    </option>
			                	
			                	@foreach($users as $user)
			                		
			                		@if( $user->id != Auth::user()->id)

				                		<option value="{{ $user->id }}" id="nameN{{ $user->id }}">
				                			
				                			{{ $user->name." ".$user->last_name }}
				                		
				                		</option>

				                	@else
				                	@endif

			                	@endforeach

		                </select>
		            </div>
		            <div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <img src="

		                        	{{ asset('icons/tokens.svg') }}

		                        	" width="24">
		                    </span>
		                </div>
		                <input type="number" id="amount" name="amount" class="form-control" placeholder="{{ trans('global.amount') }}" required>
		            </div>
		            <div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">description</i>
		                    </span>
		                </div>
		                <textarea name="description" cols="" rows="2" class="form-control" maxlength="255" placeholder="{{ trans('global.description') }}"></textarea>
		            </div>
		            <div class=" text-center">
		                <!-- Button trigger modal -->
						<button type="button" id="payBtn" class="btn btn-primary btn-lg btn-wd btn-link" data-toggle="modal" data-target="#modalWallet">
							{{ trans('global.pay') }}
						</button>

						

		                	

		                </input>
		            </div>
		        </div>
		    </form>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="modalWallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content col-md-8 mr-auto ml-auto">
		      		<div class="modal-header">
                		<h6 class="h3 text-uppercase ml-auto mr-auto" style="color: #000;">{{ trans('global.wallet') }}</h6>  
		        		
		        
		      		</div>
		      		<div class="modal-body text-center">
		      			<span class="h4" id="nameC" style="color: #000;"></span>
		                    <br>
		                    <br>
		                <p class="card-text" style="vertical-align: middle;">
		                    <img src="{{ asset('icons/tokens.svg') }}" width="19px" style="margin: -10px 5px 0px 0px;">
		                    <span id="amountC" class="h4" style="color: #000;"></span>
					    </p>
		                
		                <p class="py-3" style="color: #000;">{{ trans('global.payConf') }}</p>
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
      				<div class="modal-footer">
        				<input type="submit" id="pay" class="btn btn-primary ml-auto mr-auto" form="payForm" value="{{ trans('global.pay') }}">
		        		<button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
			      	</div>
		    	</div>
		  	</div>
		</div>
    </div>
</div>
<div class="text-center py-4" name="anchorPoint" id="anchorPoint">

	@foreach($operations as $operation)
	    
	    @if(Auth::user()->id == $operation->from_user)

		    <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px;">
				<div class="card" style="width: 275px; display: inline-block; margin: 0px">
					<div class="front">
						<div class="card-body">

						    @foreach($users as $user)

						        @if($user->id == $operation->to_user)

							        <h4 class="card-text h4 text-uppercase">

						        		{{ $user->name }}

						        	</h4>
	                                <span class="h4 text-uppercase">

	                                	{{ $user->last_name }}

	                                </span>
						        @else

						        @endif

					        @endforeach

	            			<div class="py-5" style="vertical-aling: middle">
	            			    <span>
	                                <img src="

                                		{{ asset('icons/tokens.svg') }}

                                		" width="21" style="margin-top: -3px;">
	                            </span>
	            				<span class="card-text text-danger text-muted h4 text-uppercase py-5" style="vertical-align: middle;">

		                			{{ $operation->amount }}

		                		</span>
		                	</div>
						</div>
						<div class="card-footer" style="position: absolute; bottom: 0px; left: 18%;">
						 	<button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">

							 	{{ trans('global.details') }}

							</button>
						</div>
					</div>
					<div class="back">
						<div class="card-body" style="vertical-align: middle;">
							<button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; right: 9.25px; top: 5.47px;">
		      					<span aria-hidden="true">&times;</span>
		    				</button>
						 	<h4 class="card-text h4 text-uppercase" style="display: inline-block;">

						 		{{ trans('global.reason') }}

						 	</h4>
						 	<div class="text-center mr-auto ml-auto">
						        <span class="mr-auto ml-auto">

					        		{{ $operation->created_at }}

					        	</span>
						    </div>
						 	<div class="force-scroll-p contenedor-p" style="height: 190px;">
	            				<span class="card-text text-muted h4">

	                    			{{ $operation->description }}

	                    		</span>
	                    	</div>
						</div>
					</div>
				</div>
			</div>
	    @elseif(Auth::user()->id == $operation->to_user)

	    	<div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px;">
				<div class="card" style="width: 275px; display: inline-block; margin: 0px">
					<div class="front">
						<div class="card-body">

						    @foreach($users as $user)

						        @if($user->id == $operation->from_user)

							        <h4 class="card-text h4 text-uppercase">

							        	{{ $user->name }}

							        </h4>
	                                <span class="h4 text-uppercase">

	                                	{{ $user->last_name }}

	                                </span>
						        @else

						        @endif

					        @endforeach
	            			<div class="py-5" style="vertical-aling: middle">
	            			    <span>
	                                <img src="
	                                	
	                                	{{ asset('icons/tokens.svg') }}

	                                	" width="21" style="margin-top: -3px;">
	                            </span>
	            				<span class="card-text text-success text-muted h4 text-uppercase py-5" style="vertical-align: middle;">
		                			
		                			{{ $operation->amount }}
		                		
		                		</span>
		                	</div>
						</div>
						<div class="card-footer" style="position: absolute; bottom: 0px; left: 18%;">
						 	<button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
							 	
							 	{{ trans('global.details') }}
							
							</button>
						</div>
					</div>
					<div class="back">
						<div class="card-body" style="vertical-align: middle;">
							<button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; right: 9.25px; top: 5.47px;">
		      					<span aria-hidden="true">&times;</span>
		    				</button>
						 	<h4 class="card-text h4 text-uppercase" style="display: inline-block;">

						 		{{ trans('global.reason') }}

						 	</h4>
						 	<div class="text-center mr-auto ml-auto">
						        <span class="mr-auto ml-auto">
					        		
					        		{{ $operation->created_at }}
					        	
					        	</span>
						    </div>
						 	<div class="force-scroll-p contenedor-p" style="height: 190px;">
	            				<span class="card-text text-muted h4">
	                    			
	                    			{{ $operation->description }}
	                    		
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

{{ $operations->links() }}          

@endsection

@section('script')
<script>
	function validatePay()
	{
		var sendPay = document.getElementById('pay');
		var wallet = "{{ $wallet }}";
		var amountPay = document.getElementById('amount').value;

		if (parseInt(wallet) < parseInt(amountPay))
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