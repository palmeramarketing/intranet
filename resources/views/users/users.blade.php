@extends('layouts.app')

@section('title')
	{{ trans('global.users') }}
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
		.modal-backdrop	{
			z-index: -3;
		}		
		.card-container, .front, .back
		{
		    height: 360px;
		}
		.modal-register
		{
			padding: 0px !important;
		}
	</style>
	<div class="page-header py-5">
    	<div class="container text-center" style="padding-top: 6rem;">
        	<div class="card card col-md-5" style="display: inline-block" >
    			<form class="form" method="POST" name="registerForm" id="registerForm" action="{{ route('user.store') }}" autocomplete="off">
		        	<div class="card-header card-header-primary text-center h" style="z-index: 10000;">
		            	<h6 class="h3 text-uppercase">{{ trans('global.users') }}</h6>
		        	</div>
        			<div class="card-body" style="padding: 15px 30px 15px 10px;">
						            
	            		<div class="input-group">
		                	<div class="input-group-prepend">
		                    	<span class="input-group-text">
		                        	<i class="material-icons">person</i>
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
			                <input type="text" name="last_name" id="lastName" class="form-control" pattern="[A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.lastName') }}" style="margin-left: 0px;" required="on">
			            </div>
			            <div class="input-group">
			                <div class="input-group-prepend">
			                    <span class="input-group-text">
			                        <i class="material-icons">mail</i>
			                    </span>
			                </div>
			                <input type="email" name="email" id="email" class="form-control" placeholder="{{ trans('global.email') }}" value="" required="on" autocomplete="off" pattern="[A-Za-z]+@palmera.marketing" title="Debe ser una dirección de correo de Palm Era">
			            </div>
			            <div class="input-group">
			            	<div class="input-group-prepend">
			                    <span class="input-group-text">
			                        <i class="material-icons">group</i>
			                    </span>
			                </div>
			                <select class="form-control" name="type" id="type">
			                	<option value="1" selected disabled value="">
			                		{{ trans('global.user') }}/{{ trans('global.admin') }}
			                	</option>

			                	<option value="1"> 
			                		{{ trans('global.user') }}
			                	</option>

			                	<option value="2">
			                		{{ trans('global.admin') }}
			                	</option>
			                </select>
			            </div>
			            <div class="input-group">
			            	<div class="input-group-prepend">
			                    <span class="input-group-text">
			                        <i class="material-icons">group_work</i>
			                    </span>
			                </div>
			                <select class="form-control" name="department" id="department">
			                	<option selected disabled value="">
			                		{{ trans('global.department') }}
			                	</option>
			                	@foreach($departments as $department)
			                		<option value="{{ $department->id }}">
			                			{{ $department->name }}
			                		</option>
			                	@endforeach
			                </select>
			            </div>
			            <div class="input-group">
			            	<div class="input-group-prepend">
			                    <span class="input-group-text">
			                        <i class="material-icons">vpn_key</i>
			                    </span>
			                </div>
			                <input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('global.password') }}" value="" required="on" autocomplete="off">
			            </div>
			            <div class=" text-center" style="padding: 15px 0px 0px 0px;">
							<button type="button" id="registerLM" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalregister">
								{{ trans('global.registerUser') }}
							</button>
							
			            </div>
		        	</div>
    			</form>
			</div>
			<div class="modal-register modal fade" id="exampleModalregister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document" {{-- style="margin: 0px;" --}}>
			    	<div class="modal-content col-md-8 ml-auto mr-auto" style="height: 389px; width: ">
			    		<div class="card-header card-header-primary text-center h" style="z-index: 10000;">
		            		<h6 class="h3 text-uppercase" style="color: #000;">{{ trans('global.users') }}</h6>
		        		</div>
			      		<div class="modal-body text-center">
			        		<span class="h3" id="nameC" style="color: #000;"></span>
			        			<br>
			        		<span class="h3" id="lastNameC" style="color: #000;"></span>
			        			<br>
			        		<span class="h4 text-muted" id="emailC">mail@kslsl.cn</span>
			        		<p class="py-3" style="color: #000;">{{ trans('global.registerConf') }}</p>
					        <script>
					        	function confirmationRegister()
					        	{
					        		var name = document.getElementById('name');
					        		var lastName = document.getElementById('lastName');
					        		var email = document.getElementById('email');
					        		var nameC = document.getElementById('nameC');
					        		var lastNameC = document.getElementById('lastNameC');
					        		var emailC = document.getElementById('emailC');
					        		nameC.innerHTML = name.value;
					        		lastNameC.innerHTML = lastName.value;
					        		emailC.innerHTML = email.value; 
					        	}
				        		var registerLM = document.getElementById('registerLM');
				        		registerLM.addEventListener('click', confirmationRegister);
					        	// setInterval("confirmationRegister()", 50);
					        	function validate()
					        	{
					        		//
					        	}
					        </script>
			      		</div>
			      		<div class="modal-footer text-center" style="padding: 15px 0px 15px 0px;">
        					<input type="submit" class="btn btn-primary ml-auto mr-auto" form="registerForm" name="registrar" value="{{ trans('global.registerUser') }}"></input>
        					<button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
			      		</div>
			    	</div>
			  	</div>
			</div>
    	</div>
	</div>
	
	<div class="text-center py-5" name="anchorPoint" id="anchorPoint">
	    @if($users->count())
	        @foreach($users as $user)
	            <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px;">
					<div class="card" style="width: 275px; display: inline-block; margin: 0px">
						<div class="front">
							<div class="card-img-top" style="width: 275px; height: 232px; background-image: url('{{ asset('public/avatar/'.$user->img) }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
							</div>
							<div class="card-body" style="padding-top: 10px;">
								<h4 class="card-text h4 text-uppercase" style="margin: 0px;">{{ $user->name }}</h4>
	                            <span class="h4 text-uppercase">{{ $user->last_name }}</span>
		                	    <div class="" style="background-image: url('{{ asset('assets/img/bg7.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
							</div>
							<div class="card-footer" style="position: absolute; bottom: -10px; left: 20%;">
							 	<button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
								 	{{ trans('global.edit') }}
								</button>
							</div>
						</div>
						<div class="back">
							<div class="card-body" style="vertical-align: middle;">
								<button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; right: 9.25px; top: 5.47px;">
			      					<span aria-hidden="true">&times;</span>
			    				</button>
							 	<h4 class="card-text h4 text-uppercase" style="display: inline-block;">{{ trans('global.edit') }}</h4>
								<form class="form py-3" id="form-update-{{ $user->id }}" name="form-update-{{ $user->id }}" method="POST" action="{{ route('user.update', $user->id) }}" role="form">
					    			{{ csrf_field() }}
					    			<input name="_method" type="hidden" value="PATCH">
						            	<div class="input-group">
							                <div class="input-group-prepend">
							                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
							                        <i class="material-icons">person</i>
							                    </span>
							                </div>
						                	<input type="text" name="name" class="form-control" pattern="[A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.name') }}" style="" required="on" value="{{ $user->name }}">
						            	</div>
							            <div class="input-group">
							                <div class="input-group-prepend">
							                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
							                        <i class="material-icons">person</i>
							                    </span>
							                </div>
							                <input type="text" name="last_name" class="form-control" pattern="[A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.lastName') }}" style="margin-left: 0px;" required="on" value="{{ $user->last_name }}">
							            </div>
							            <div class="input-group">
							                <div class="input-group-prepend">
							                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
							                        <i class="material-icons">mail</i>
							                    </span>
							                </div>
							                <input type="email" name="email" class="form-control" placeholder="{{ trans('global.email') }}" required="on" value="{{ $user->email }}" pattern="[A-Za-z]+@palmera.marketing" title="Debe ser una dirección de correo de Palm Era">
							            </div>
							            <div class="input-group">
							            	<div class="input-group-prepend">
							                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
							                        <i class="material-icons">group</i>
							                    </span>
							                </div>
							                <select class="form-control" name="type">
								                	<option value="user" disabled>
								                		{{ trans('global.user') }}/{{ trans('global.admin') }}
								                	</option>
								                     @if($user->type == "1")
									                	<option value="1" selected >
									                		{{ trans('global.user') }}
									                	</option>

									                	<option value="2">
									                		{{ trans('global.admin') }}
									                	</option>
								                    @elseif($user->type == "2")
									                	<option value="1">
									                		{{ trans('global.user') }}
									                	</option>

									                	<option value="2" selected>
									                		{{ trans('global.admin') }}
									                	</option>
								                    @else
								                    @endif
							                </select>
							            </div>
							            <div class="input-group">
							            	<div class="input-group-prepend">
							                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
							                        <i class="material-icons">group_work</i>
							                    </span>
							                </div>
							                <select class="form-control" name="department" >
					                	        <option disabled>
					                		        {{ trans('global.department') }}
					                	        </option>
							                	@foreach($departments as $department)
							                			@if($user->department == $department->id)
							                				<option selected value="{{ $department->id }}">
									                			{{ $department->name }}
									                		</option>
							                			@else
															<option value="{{ $department->id }}">
									                			{{ $department->name}}
									                		</option>
							                			@endif
							                	@endforeach
					                        </select>
							            </div>
							            <div class="card-footer" style="position: absolute; bottom: 0px;">
											<button type="button" class="btn btn-sm btn-info btn-fab btn-round" data-toggle="modal" data-target="#exampleModal-{{ $user->id."-".$user->id."-".$user->id }}" style="position: fixed; left: 5px; margin-left: 15px; bottom: 15px">
										 		<i class="material-icons">vpn_key</i>
											</button>
											<div class="modal fade" id="exampleModal-{{ $user->id."-".$user->id."-".$user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										  		<div class="modal-dialog" role="document" style="margin: 0px;">
											    	<div class="modal-content" style="width: 275px; height: 360px;">
											      		<div class="modal-body">
											        		<p class="py-5">
										        				{{ trans('global.passwordResConf').$user->name." ".$user->last_name }}?
											        			{{ trans('global.newPassword') }}
											        		</p>
											      		</div>
											      		<div class="modal-footer text-center" style="height: 65px;">
											      			<a class="btn btn-md btn-info ml-auto mr-auto" href="https://palmera.marketing/tokens/passwordReset/{{ $user->id }}">
											      				{{ trans('global.reset') }}
												 			</a>											        
		                									<button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
											      		</div>
											    	</div>
											  	</div>
											</div>
											<button type="button" class="btn btn-success btn-fab btn-round btn-sm" data-toggle="modal" data-target="#exampleModal-{{ $user->id }}-{{ $user->id }}">
												<i class="material-icons">refresh</i>
											</button>
											<div class="modal fade" id="exampleModal-{{ $user->id }}-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  	<div class="modal-dialog" role="document" style="margin: 0px;">
											    	<div class="modal-content" style="width: 275px; height: 360px;">
											      		<div class="modal-body">
											      			<div class="text-center ">
				    					        			</div>
			    					        				<p class="py-5">{{ trans('global.updateConf').$user->name." ".$user->last_name }}?</p>      	
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
							<button type="button" class="btn btn-danger btn-fab btn-round btn-sm" data-toggle="modal" data-target="#exampleModal2-{{ $user->id }}" style="position: fixed; right: 10px; margin-right: 15px; bottom: 15px;">
							 	<span class="glyphicon glyphicon-trash">
									<i class="material-icons">delete</i>
								</span>
							</button>
							<div class="modal fade text-center" id="exampleModal2-{{ $user->id }}" tabindex="3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">
        				  	<div class="modal-dialog" role="document" style="margin: 0px;">
        				    	<div class="modal-content" style="width: 275px; height: 360px";>
        					      	<div class="modal-body">
        					      		<div class="text-center ">
        					        	</div>
        					      		<p class="py-5">{{ trans('global.deleteConf').$user->name." ".$user->last_name }}?</p>
        					      	</div>
        				      		<div class="modal-footer text-center">
        				        		<form class="form-inline text-center mr-auto ml-auto" action="{{action('UserController@destroy', $user->id)}}" method="post">
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
	    @else
	    
	    @endif     
	</div>
	    {{ $users->links() }}
@endsection

@section('script')
@endsection