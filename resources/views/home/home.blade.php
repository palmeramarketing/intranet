@extends('layouts.app')
	@section('title')
		{{ trans('global.home') }}
	@endsection

	@section('stylesheet')
	@endsection
	
	@section('navbar')
    	@include('layouts.navbar')
	@endsection

	@php
	    use App\Wallet;
	    $wallet = Wallet::where('id_user', Auth::user()->id)->value('amount');
	@endphp

	@section('stylesheet')
		
	@endsection
	@section('content')
		<style>
		    body
            {
                background: rgba(165,105,189,1);
            }
            .modal-backdrop
            {
		        z-index: -3;
		    }
		</style>  
		   
	    	@include('layouts.slider')
	    
		    <div class="text-center py-5" style="padding: 0px;" name="anchorPoint" id="anchorPoint">
				@if($products->count())  
					@foreach($products as $product)
						<div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px;" name="{{ $product->name."-".$product->id }}" id="{{ $product->name."-".$product->id }}">
							<div class="card" style="width: 275px; display: inline-block; margin: 0px">
								<div class="front">
									<div class="card-img-top" style="width: 275px; height: 232px; background-image: url('{{ asset('uploads/'.$product->img) }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
									</div>
									
									<div class="card-body">
										<h4 class="card-text h4 text-uppercase text-truncate" style="max-height: 27px;">{{ $product->name }}</h4>
										<p class="card-text" style="vertical-align: middle;">
						                    <img src="{{ asset('icons/tokens.svg') }}" width="19px" style="margin: -10px 5px 0px 0px;">
						                    <span class="h4">{{ $product->price }}</span>
									    </p>
									</div>
									<div class="card-footer text-center" style="position: absolute; bottom: 0px; left: 23%;">
									 	<button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
										 	{{ trans('global.more') }}
										</button>
									</div>
								</div>
								{{-- 
									Ajustar el diseño
								 --}}
								<div class="back">
									<div class="card-body" style="vertical-align: middle;">
										<button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; top: 2px; right: 8px;">
					      					<span aria-hidden="true">&times;</span>
					    				</button>
										<h4 class="card-text h4 text-uppercase text-truncate" style="max-height: 27px;">{{ $product->name }}</h4>
										
										<p class="card-text" style="vertical-align: middle;">
						                    <img src="{{ asset('icons/tokens.svg') }}" width="19px" style="margin: -10px 5px 0px 0px;">
						                    <span class="h4">{{ $product->price }}</span>
									    </p>
										<p class="card-text text-justify force-scroll-p contenedor-p" style="height: 200px; /*overflow-y: hidden*/" >
											{{ $product->description }}
										</p>
										
										{{-- <span><a href="{{ route('productInfo', $product->id) }}">{{ trans('global.seeMore') }}</a> </span> --}}
									</div>
									<div class="card-footer" style="position: absolute; bottom: 0px; left: 17.5%;">
										<form action="{{ route('purchaseRequest') }}" method="post" accept-charset="utf-8">
									    	<input type="hidden" name="product_id" value="{{ $product->id }}">
									    	<input type="hidden" name="product_name" value="{{ $product->name }}">
						  					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
						  					<input type="hidden" name="admin" value="{{ $product->admin }}">
						  					@if($product->price > $wallet)
												<button type="submit" class="btn btn-primary ml-auto mr-auto" name="purchase" value="{{ trans('global.purchase') }}" disabled>{{ trans('global.purchase') }}</button>
											@else
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalConfPurchase-{{ $product->id }}">
													{{ trans('global.purchase') }}											  	
												</button>

												<!-- Modal -->
												<div class="modal fade" id="modalConfPurchase-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document" style="margin: 0px;">
												    	<div class="modal-content" style="width: 275px; height: 420px;">
												      		<div class="modal-header">
													      	</div>
												      		<div class="modal-body py-5">
												        		{{ trans('global.purchaseConf') }}
												      		</div>
												      <div class="modal-footer text-center">
												      	<button type="submit" class="btn btn-primary ml-auto mr-auto" name="purchase" value="{{ trans('global.purchase') }}">{{ trans('global.purchase') }}</button>
												        <button type="button" class="btn btn-default mr-auto ml-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
												      </div>
												    </div>
												  </div>
												</div>
												
											@endif	
									    </form>
									</div>
								</div>
							</div>
						</div>
					@endforeach 
				@else
		 		@endif
		    </div>
		    <div class="py-3">
		    	{{ $products->links() }}
		    </div>
	@endsection
@section('script')
@endsection