@extends('layouts.app')

@section('title')
	{{-- $product->name --}}
@endsection

@section('stylesheet')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@php
    use App\Bank;
    use App\Wallet;
    use App\Department;
    use App\User;
    $users = User::get();
    $banks = Bank::get();
    $wallet = Wallet::where('id_user', Auth::user()->id);
    $general_amount = 0;
    $departments = Department::get();
@endphp

@section('content')
<style>
    body
    {
        background-color: #7FB2A5;
    }       
</style>
<div class="text-center" style="padding-top: 110px;">
    <div class="card col-md-3 col-11 mr-auto ml-auto" style="display: inline-block; margin: 0px; height: 700px; margin-bottom: 20px; padding-left: 0px; padding-right: 0px;">   
        
        	<div class="">
				{{--<div class="card-img-top col-md-12" style="height: 300px; background-image: url('{{ asset('uploads/'.$product->img) }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">--}}
				</div>
				
				<div class="card-body">
					<h4 class="card-text h4 text-uppercase text-truncate" style="max-height: 27px;">Lorem</h4>
					<p class="card-text" style="vertical-align: middle;">
	                    <img src="{{ asset('icons/tokens.svg') }}" width="19px" style="margin: -10px 5px 0px 0px;">
	                    <span class="h4">Lorem</span>
				    </p>
				</div>
				<p class="card-text text-justify force-scroll-p contenedor-p" style="height: 200px; max-width: 300px; margin-top: 10px;" >
                    Lorem Ipsum
				</p>
				
				<div class="card-footer" style="position: absolute; bottom: 0px; left: 20%;">
    				<form action="{{ route('purchaseRequest') }}" method="post" accept-charset="utf-8">
    			    	{{--<input type="hidden" name="product_id" value="{{ $product->id }}">
    			    	<input type="hidden" name="product_name" value="{{ $product->name }}">
      					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
      					<input type="hidden" name="admin" value="{{ $product->admin }}">--}}
      					@if(True)
    						<button type="submit" class="btn btn-primary ml-auto mr-auto" name="purchase" value="{{ trans('global.purchase') }}" disabled>{{ trans('global.purchase') }}</button>
    					@else
    						<button type="submit" class="btn btn-primary ml-auto mr-auto" name="purchase" value="{{ trans('global.purchase') }}">{{ trans('global.purchase') }}</button>
    					@endif	
    			    </form>
    			</div>
			</div
    </div>
</div>


    


@endsection

@section('script')
    <style type="text/css" media="screen">
		.modal-backdrop	{
			z-index: -3;
		}		
		
	</style>

@endsection