@extends('layouts.app')

@section('title')
	{{ trans('global.products') }}
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
			background-color: #79E2DB;
		}
		.modal-backdrop	{
			z-index: -3;
		}
		.card-container, .front, .back
		{
		    height: 390px;
		}
	</style>

<div class="page-header">
    <div class="container text-center" style="padding-top: 6rem;">
        <div class="card card col-md-5" style="display: inline-block;" >
    		<form class="form" name="registerForm" id="registerForm" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
		        <div class="card-header card-header-primary text-center h">
		            <h6 class="h3 text-uppercase">{{ trans('global.products') }}</h6>
		        </div>
        		<div class="card-body" style="padding: 15px 30px 15px 10px;">
	            	<div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">add_shopping_cart</i>
		                    </span>
		                </div>
	                	<input type="text" name="name" id="name" class="form-control" pattern="[1-9A-Za-zñNáÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.products') }}" style="" required="on">
	            	</div>
	            	<div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">description</i>
		                    </span>
		                </div>
		                <textarea name="description" cols="20" rows="2" class="form-control" maxlength="" placeholder="{{ trans('global.description') }}"></textarea>
		            </div>
		            <div class="input-group">
		            	<div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">person</i>
		                    </span>
		                </div>
		                <select class="form-control" name="admin" >
		                	<option selected disabled value="">
		                		{{ trans('global.responsable') }}
		                	</option>
		                	@foreach($users as $user)
		                		@if( $user->type != 1)
			                		<option value="{{ $user->id }}">
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
			                	<img src="{{ asset('icons/tokens.svg') }}" id="" alt="" width="24">
			                </span>
		                </div>
		                <input type="number" id="price" name="price" class="form-control" placeholder="{{ trans('global.price') }}" style="margin-left: 0px;" required="on">
		            </div>
		            <div class="input-group">
		                <div class="input-group-prepend">
		                    <span class="input-group-text">
		                        <i class="material-icons">insert_photo</i>
		                    </span>
		                </div>
		                <span class="file-upload">
		                	<input type="file" id="file-upload" onchange="cambiar()" accept="image/*" name="img" id="img" class="form-control" placeholder="Precio" style="display:none;" required>
		                </span>
		                <input type="text" name="" id="info" class="form-control" disabled style="background-color: #fff;">
		                <label for="file-upload" class="subir btn btn-primary btn-fab btn-round">
		               		<i class="material-icons">attach_file</i>							
		                </label>
		            </div>
		            <div class=" text-center">
		            	<!-- Button trigger modal -->
							<button type="button" id="registerBTN" class="btn btn-primary btn-link btn-btn-wd btn-lg" data-toggle="modal" data-target="#modalProductRegister">
							 	{{ trans('global.registerUser') }}
							</button>

						

		            </div>
		        </div>
    		</form>
		</div>
		<!-- Modal -->
			<div class="modal fade" id="modalProductRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			 	<div class="modal-dialog" role="document">
			    	<div class="modal-content col-md-8 ml-auto mr-auto">
			      		<div class="modal-header text-center">
		            		<h6 class="h3 text-uppercase ml-auto mr-auto" style="color: #000;">{{ trans('global.products') }}</h6>	
			      		</div>
				      	<div class="modal-body">
				      		<h4 id="nameC" class="card-text h4 text-uppercase text-truncate" style="max-height: 27px; color: #000;"></h4>
							<p class="card-text" style="vertical-align: middle;">
			                    <img src="{{ asset('icons/tokens.svg') }}" width="19px" style="margin: -10px 5px 0px 0px;">
			                    <span id="priceC" class="h4" style="color: #000;"></span>
						    </p>

				        	<p class="py-3" style="color: #000;">{{ trans('global.registerProductConf') }}</p>
				        	<script>
								function confirmationRegister()
								{
									//
									var name = document.getElementById('name'),
										price = document.getElementById('price'),
										nameC = document.getElementById('nameC'),
										priceC = document.getElementById('priceC');

									nameC.innerHTML = name.value;
									priceC.innerHTML = price.value;

								}
								// var registerBtn = document.getElementById('registerBTN');
								// registerBtn.addEventListener('click', confirmationRegister); 
								setInterval("confirmationRegister()", 50); 
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
       

<div class="text-center py-4" name="anchorPoint" id="anchorPoint">
	@if($products->count())  
		@foreach($products as $product)
		    <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px;">
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
						<div class="card-footer text-center" style="position: absolute; bottom: 0px; left: 20%;">
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
						 	<form class="form py-3" method="POST" action="{{ route('product.update', $product->id) }}" role="form" enctype="multipart/form-data">
				    			{{ csrf_field() }}
				    			<input name="_method" type="hidden" value="PATCH">
				            	<div class="input-group">
					                <div class="input-group-prepend">
					                    <span class="input-group-text" style="padding-left: 0px;">
					                        <i class="material-icons">add_shopping_cart</i>
					                    </span>
					                </div>
				                	<input type="text" name="name" class="form-control" placeholder="Producto" style="" required="on" value="{{ $product->name }}">
				            	</div>
					            <div class="input-group">
					                <div class="input-group-prepend">
					                    <span class="input-group-text" style="padding-left: 0px;">
					                        <i class="material-icons">description</i>
					                    </span>
					                </div>
					                <textarea name="description" cols="20" rows="3" class="form-control" maxlength="" placeholder="Descripción" value="{{ $product->description }}">{{ $product->description }}</textarea>
					            </div>
					            <div class="input-group">
					            	<div class="input-group-prepend">
					                    <span class="input-group-text" style="padding-left: 0px;">
					                        <i class="material-icons">person</i>
					                    </span>
					                </div>
					                <select class="form-control" name="admin" >
					                	<option disabled>
					                		Supervisor
					                	</option>
					                	@foreach($users as $user)
					                		@if( $user->type != 1)
					                			@if($user->id == $product->admin)
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
					                    <span class="input-group-text" style="padding-left: 0px;">
					                        <img src="{{ asset('icons/tokens.svg') }}" id="" alt="" width="24">
					                    </span>
					                </div>
					                <input type="number" name="price" class="form-control" placeholder="Precio" style="margin-left: 0px;" required="on" value="{{ $product->price }}">
					            </div>
					            <div class="input-group">
					                <div class="input-group-prepend">
					                    <span class="input-group-text" style="padding-left: 0px;">
					                    	
					                        <i class="material-icons">insert_photo</i>
					                    </span>
					                </div>
					                <span class="file-upload">
					                	<input type="file" id="file-upload-{{ $product->id }}" onchange="cambiar_{{ $product->id }}()" accept="image/*" name="img" id="img" class="form-control" placeholder="Precio" style="display:none;">
					                </span>
					                <input type="text" name="" id="info-{{ $product->id }}" class="form-control" disabled style="background-color: #fff;" value="">
					                <label for="file-upload-{{ $product->id }}" class="subir btn btn-primary btn-fab btn-round" value="">
					               		<i class="material-icons">attach_file</i>							
					                </label>
					                <script type="application/javascript">
										function cambiar_{{ $product->id }}(){
								    		var pdrs = document.getElementById('file-upload-{{ $product->id }}').files[0].name;
								   			document.getElementById('info-{{ $product->id }}').value = pdrs;
										}
									</script>
					            </div>
					            <div class=" text-center">
					                <button type="button" class="btn btn-success btn-fab btn-round btn-sm" data-toggle="modal" data-target="#exampleModal-productedir-{{ $product->id }}" style="position: fixed; bottom: 20px; left: 20px;">
  										<i class="material-icons">refresh</i>
									</button>

<!-- Modal -->
									<div class="modal fade" id="exampleModal-productedir-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  	<div class="modal-dialog" role="document" style="margin: 0px;">
									    	<div class="modal-content" style="width: 275px; height: 390px;">
									      		<div class="modal-body">
					        						<p class="py-5">{{ trans('global.updateConf').$product->name }}?</p>      	
									      		</div>
									      		<div class="modal-footer text-center" style="">
									        		<input type="submit" class="btn btn-success btn-wd btn-md mr-auto ml-auto" name="actualizar" value="{{ trans('global.update') }}">
    												<button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>

									      		</div>
									    	</div>
									  	</div>
									</div>
					            </div>
				    		</form>
				    		<button type="button" class="btn btn-danger btn-fab btn-round btn-sm" data-toggle="modal" data-target="#exampleModal2-{{ $product->id }}" style="position: fixed; right: 10px; margin-right: 15px; bottom: 20px;">
							 	<span class="glyphicon glyphicon-trash">
									<i class="material-icons">delete</i>
								</span>
							</button>
							<div class="modal fade text-center" id="exampleModal2-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">
							  	<div class="modal-dialog" role="document" style="margin: 0px;">
							    	<div class="modal-content" style="width: 275px; height: 390px;">
								      	<div class="modal-body">
								      		<div class="text-center">
								        	</div>
								      		<p class="py-5">{{ trans('global.deleteConf').$product->name }}?</p>
								      	</div>
							      		<div class="modal-footer text-center">
							        		<form class="form-inline text-center mr-auto ml-auto" action="{{action('ProductsController@destroy', $product->id)}}" method="post">
												{{ csrf_field() }}
												<input name="_method" type="hidden" value="DELETE">
												<button class="btn btn-danger" type="submit">
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
	@endif
</div>

{{ $products->links() }}

@endsection

@section('script')
	<script type="application/javascript">
		function cambiar()
		{
    		var pdrs = document.getElementById('file-upload').files[0].name;
   			document.getElementById('info').value = pdrs;
		}
	</script>
@endsection