@extends('layouts.app')

@section('title')
	{{ trans('global.password') }}
@endsection

@section('stylesheet')

@endsection

@php
	use Illuminate\Support\Facades\Crypt;
@endphp

@section('navbar')
	@include('layouts.navbar')
@endsection

@section('content')
	<style>
		body
		{
			background-color: #00A6CE;
		}		
	</style>
<div class="page-header">
    <div class="container text-center py-5">
        <div class="card car-login card col-md-5" style="display: inline-block" >
        	
    		<form class="form" id="" method="POST" action="{{ route('CP', Auth::user()->id) }}" role="form">
    			{{ csrf_field() }}
    			{{-- <input name="_method" type="hidden" value="PATCH"> --}}
		        <div class="card-header card-header-primary text-center h">
		            <h6 class="h3 text-uppercase">{{ trans('global.password') }}</h6>
		        </div>
		        <p class="description text-center text-uppercase">{{ trans('global.passwordMC') }}</p>
        		<div class="card-body py-3" style="padding-left: 15px; padding-right: 15px; " >
        			{{-- <input type="hidden" name="id" value="{{  }}"> --}}
	            	<div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text" style="">
		                        <i class="material-icons">vpn_key</i>
		                    </span>
		                </div>
	                	<input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('global.passwordN') }}" style="" required="on">
	                	<button type="button" class="btn btn-sm btn-link" onclick=" cambiar();"><i class="material-icons">remove_red_eye</i></button>
	            	</div>
	            	<div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">vpn_key</i>
		                    </span>
		                </div>
	                	<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" placeholder="{{ trans('global.passwordC') }}" style="" required="on">
	                	<button type="button" class="btn btn-sm btn-link" onclick=" cambiar2();"><i class="material-icons">remove_red_eye</i></button>
	            	</div>
		            <div class="text-center">
		                <input type="submit" class="btn btn-primary btn-link btn-wd btn-lg" id="changePasswordButton" name="registrar" value="{{ trans('global.change') }}" disabled>
		            </div>
		        </div>
    		</form>
		</div>
    </div>
</div>
@endsection
@section('script')
	<script type="application/javascript">
		function cambiar()
		{
    		var password = document.getElementById('password');
     		if (password.type == 'password')
    		{
    			password.type = 'text';
    		}
    		else
    		{
    			password.type = 'password';
    		}
		}
		function cambiar2()
		{
    		var passwordConfirm = document.getElementById('passwordConfirm');
    		if (passwordConfirm.type == 'password')
    		{
    			passwordConfirm.type = 'text';
    		}
    		else
    		{
    			passwordConfirm.type = 'password';
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