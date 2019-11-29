@extends('layouts.app')

@section('title')
	{{ trans('global.department') }}
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
    $wallets = Wallet::get();
    $general_amount = 0;
    // $departments = Department::get();
@endphp

@section('content')
<style>
    body
    {
        background-color: #7FB2A5;
    }       
</style>
<div class="page-header">        
    <div class="container text-center" style="padding-top: 1.5rem;">
        {{-- formulario para la cracion de bancos y departamentos --}}
        <div class="card card col-md-5 f-p-m" style="display: inline-block" >
                <form class="form" id="registerForm" name="registerForm" method="POST" action="{{ route('bankCreate') }}">
                    <div class="card-header card-header-primary text-center h">
                        <h6 class="h3 text-uppercase">{{ trans('global.department') }}</h6>
                    </div>
                    <div class="card-body" style="padding: 15px 30px 15px 10px;">
                                    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">group_work</i>
                                </span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control" pattern="[A-Za-záÁéÉíÍóÓúÚ\s]{1,255}" placeholder="{{ trans('global.name') }}" style="" required="on">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">person</i>
                                </span>
                            </div>
                            <input type="hidden" name="from" id="from" value="{{ Auth::user()->id }}">
                            <select name="admin" id="admin" class="form-control" required="on">
                                <option selected="on" disabled value="" id="adminN">
                                    {{ trans('global.admin') }}
                                </option> 
                                @foreach($users as $user)
                                    @if( $user->type == 2)
                                        <option value="{{ $user->id }}" id="adminN{{ $user->id }}">
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
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Monto" required patter="[0-9]{1,20}">
                        </div>
                        <div class=" text-center">
                            <button type="button" id="registerDep" class="btn btn-primary btn-link btn-wd btn-lg" data-toggle="modal" data-target="#modalRegisterDep">
                                {{ trans('global.registerUser') }}
                            </button>

                            

                        </div>
                    </div>
                </form>
        </div>
<div class="modal fade" id="modalRegisterDep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content col-md-8 ml-auto mr-auto">
            <div class="modal-header text-center">
                <h6 class="h3 text-uppercase ml-auto mr-auto" style="color: #000;">{{ trans('global.department') }}</h6>  
            </div>
            <div class="modal-body">
                <span class="h3" id="nameC" style="color: #000;"></span>
                    <br>
                <span class="h5 text-muted" id="adminC" style="color: #000;"></span>
                    <br>
                
                <p class="py-3" style="color: #000;">{{ trans('global.registerDepConf') }}</p>
                <script>
                    function registerConf()
                    {
                        //
                        var name = document.getElementById('name'),
                            admin = document.getElementById('admin'),
                            nameC = document.getElementById('nameC'),
                            adminC = document.getElementById('adminC');

                        nameC.innerHTML = name.value;
                        var adminID = document.getElementById('adminN'+admin.value);

                        adminC.innerHTML = adminID.innerText;


                    }
                    var registerDep = document.getElementById('registerDep');
                    registerDep.addEventListener('click', registerConf);
                </script>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary ml-auto mr-auto" form="registerForm" name="registrar" value="{{ trans('global.registerUser') }}"></input>
               <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
            </div>
        </div>
    </div>
</div>


        {{-- <div class="card card col-md-5 mr-auto ml-auto" style="width: 320px; height: 145px; margin-top: 10px">
            <h3 class="text-center">MONTO ACTUAL</h3>
            <br>
            <div style="vertical-aling: middle">
                <span>
                	<img src="{{ asset('icons/tokens.svg') }}" id="coin" alt="" width="30" >
                </span>
                <div style="display: inline-block; float: right; vertical-aling: middle; font-size: 30px; margin-right: 0px; clear: both;">
                    <span style="float: right;" >
                        @foreach($banks as $bank)
                            @if ($bank->name == 'Presidencia')
                                {{ $bank->amount }}
                            @else
                            @endif
                        @endforeach
                    </span>
                </div>
            </div>
        </div> --}}
        {{-- <div class="card card col-md-5 mr-auto ml-auto" style="width: 320px; height: 145px; margin-top: 30px;">
            <h3 class="text-center">EN CIRCULACIÓN</h3>
            <br>
            <div style="vertical-aling: middle">           
                <span style="">
                    <img src="{{ asset('icons/tokens.svg') }}" id="coin" alt="" width="30">
                </span>
                <div style="display: inline-block; float: right; vertical-aling: middle; font-size: 30px; margin-right: 15px">
                    <span style="float: right;">
                        @foreach($wallets as $wallet)
                            @php
                            $general_amount += $wallet->amount;
                            @endphp 
                        @endforeach
                        {{ $general_amount."" }}
                    </span>
                </div>
            </div>
        </div> --}}
    </div>
</div>


    <div class="text-center py-5" style="padding: 0px;" name="anchorPoint" id="anchorPoint">
        @if($departments->count())  
            @foreach($departments as $department)
                @foreach($banks as $bank)
                    @if($bank->name == $department->name)
                        <div class="card-container manual-flip" style="width: 275px; display: inline-block; margin: 20px; height: 350px;">
                            <div class="card" style="width: 275px; display: inline-block; margin: 0px">
                                <div class="front" style="height: 350px;">
                                    {{-- <div class="card-img-top" style="width: 275px; height: 232px; background-image: url('{{ asset('uploads/'.$product->img) }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                    </div> --}}
                                    {{-- <h4 class="card-title h4">{{ $product->name }}</h4> --}}
                                    
                                    <div class="card-body">
                                        <h4 class="card-text h4 text-uppercase text-truncate" style="height: 54px; max-height: 54px;" title="{{ $department->name }}">{{ $department->name }}</h4>
                                        {{-- <h5 class="card-text h4 text-uppercase text-truncate" style="max-height: 54px;">
                                            @foreach($users as $user)
                                                @if( $user->type)
                                                    @if($user->id == $bank->id_admin)
                                                        {{ $user->name." ".$user->last_name }}
                                                    @else
                                                                
                                                    @endif
                                                            
                                                @else
                                                
                                                @endif
                                            @endforeach
                                        </h5> --}}
                                        <p class="card-text" style="vertical-align: middle;">
                                            <img src="{{ asset('icons/tokens.svg') }}" width="21px" style="margin: -10px 5px 0px 0px;">
                                            <span class="h4">{{ $bank->amount }}</span>
                                        </p>
                                    </div>
                                    <div class="card-footer" style="position: absolute; bottom: 0px; left: 20%;">
                                        <button class="btn btn-primary mr-auto ml-auto" onclick="rotateCard(this)">
                                            {{ trans('global.more') }}
                                        </button>
                                    </div>
                                </div>
                                {{-- 
                                    Ajustar el diseño
                                 --}}
                                <div class="back" style="height: 350px;">
                                    <div class="card-body" style="vertical-align: middle;">
                                        <button type="button" class="close" onclick="rotateCard(this)" style="position: fixed; right: 9.25px; top: 5.47px;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        
                                        {{--<h4 class="card-text h4 text-uppercase" style="height: 54px;">{{ $department->name }}</h4>--}}
                                        
                                        
                                        
                                        <h4 class="card-text h4 text-uppercase" style="display: inline-block;">{{ trans('global.edit') }}</h4>
                                        @php
                                        	$idBank = $bank->id;
                                        @endphp
                                        <p class="card-text" style="vertical-align: middle;">
                                            <img src="{{ asset('icons/tokens.svg') }}" width="21px" style="margin: -10px 5px 0px 0px;" id="coin">
                                            <span class="h4" id="amountBank-{{ $bank->id}}">{{ $bank->amount }}</span>
                                        </p>

                                        <form action="{{ route('BankAndDepUpdate', $idBank) }}" class="form py-3" role="form" method="POST">

                                        	<div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
                                                        <i class="material-icons">group_work</i>
                                                    </span>
                                                </div>
                                                <input type="text" name="name" class="form-control" pattern="[A-Za-záÁéÉíÍóÓúÚ\s]{1,255}" value="{{ $bank->name }}">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="admin" >
                                                    <option disabled>
                                                        {{ trans('global.admin') }}
                                                    </option>
                                                    @foreach($users as $user)
                                                        @if( $user->type != 1)
                                                            @if($user->id == $bank->id_admin)
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
                                                    <span class="input-group-text" style="padding: 0px 15px 0px 0px;">
                                                        <img src="{{ asset('icons/tokens.svg') }}" id="" alt="" width="24">
                                                    </span>
                                                </div>

                                                {{-- input donde tenemos guardado el monto actual del banoc --}}
                                                <input type="hidden" id="amountBank{{ $bank->id }}" value="{{ $bank->amount }}">
                                                {{-- Input donde indicaremos el monto que le colocaremos al banco --}}
                                                <input type="text" name="setAmount" id="setAmount{{ $bank->id }}" class="form-control depAmount" value="" placeholder="" data-html="true" data-toggle="tooltip" data-placement="top" value="{{ $bank->amount }}" pattern="(+|-)[0-9]{2,255}" title="Esta entrada esta diseñana para realizar operaciones matematicas sobre el monto actual del banco. <br> Ejemplos de uso: <br> <span style='color: #0f0;'>+999</span> <span style='color: #fff'>text-space</span> <span style='color: #f00;'>-999</span>">
                                                <button type="button" class="btn btn-sm btn-info btn-fab btn-round" onclick="Poincare{{ $bank->id }}('+')">
                                                    <i class="material-icons">add</i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-default btn-fab btn-round" onclick="Poincare{{ $bank->id }}('-')">
                                                    <i class="material-icons">remove</i>
                                                </button>
                                                {{-- Input para enviar la informacion final de el monto del banco --}}
                                                <input type="hidden" id="finalAmount{{ $bank->id }}" name="amount">
                                                <script>
                                                    function Poincare{{ $bank->id }}(strChar)
                                                    {
                                                        var inputChar{{ $bank->id }} = document.getElementById('setAmount{{ $bank->id }}');
                                                        inputChar{{ $bank->id }}.value += strChar;
                                                    }                                                       
                                                    function Result{{ $bank->id }}()
                                                    {   
                                                        var valueInput{{ $bank->id }} = document.getElementById('setAmount{{ $bank->id }}').value; 
                                                        var result{{ $bank->id }} = eval("{{ $bank->amount }}"+valueInput{{ $bank->id }});
                                                        var finalAmount{{ $bank->id }} = document.getElementById('finalAmount{{ $bank->id }}');
                                                        finalAmount{{ $bank->id }}.value = result{{ $bank->id }};
                                                        document.getElementById('result{{ $bank->id }}').innerHTML = result{{ $bank->id }};
                                                    }
                                                    setInterval("Result{{ $bank->id }}()", 50);
                                                </script>
                                                
                                            </div>
                                            <span id="result{{ $bank->id }}" class="py-2"></span>

                                            <div class=" text-center" style="position: absolute; bottom: 15px; left: 20px;">
                                                <button type="button" class="btn btn-success btn-round btn-fab btn-sm" data-toggle="modal" data-target="#exampleModal-dep-up-{{ $department->id }}" style="position: fixed; bottom: 20px; left: 20px; margin-left: 15px;">
                                                    <i class="material-icons">refresh</i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-dep-up-{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document" style="margin: 0px;">
                                                    <div class="modal-content" style="width: 275px; height: 350px;">
                                                      <div class="modal-body">
                                                        <p class="py-5">
                                                            {{ trans('global.updateConf').$department->name }}
                                                        </p>
                                                      </div>
                                                      <div class="modal-footer">
                                                            <input type="submit" class="btn btn-success mr-auto ml-auto" name="actualizar" value="{{ trans('global.update') }}">
                                                            </input>
                                                            <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal" aria-label="Close" >
                                                                {{ trans('global.close') }}
                                                            </button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>

                                            </div>
                                            
                                        </form>
                                    </div>
                                    
                                    {{--<a class="btn btn-sm btn-danger btn-fab btn-round" href="https://palmera.marketing/tokens/BankAndDepDel/{{ $department->id }}" style="position: fixed; right: 20px; bottom: 20px;">
    							 	    <i class="material-icons">delete</i>
    							 	</a>--}}
    							 	<button type="button" class="btn btn-danger btn-fab btn-round btn-sm text-center" data-toggle="modal" data-target="#exampleModal2-{{ $department->id }}" style="position: fixed; right: 20px; margin-right: 15px; bottom: 20px;">
        							 	<span class="glyphicon glyphicon-trash">
        									<i class="material-icons">delete</i>
        								</span>
        							</button>
        							<div class="modal fade text-center" id="exampleModal2-{{ $department->id }}" tabindex="3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">
                    				  	<div class="modal-dialog" role="document" style="margin: 0px;">
                    				    	<div class="modal-content" style="width: 275px; height: 350px">
                    					      	<div class="modal-body">
                    					      		<div class="text-center ">
                    					        	</div>
                    					      		<p class="py-5">{{ trans('global.deleteConf').$department->name }}?</p>
                    					      	</div>
                    				      		<div class="modal-footer text-center">
                    				      		    <a class="btn btn-danger ml-auto mr-auto" href="{{ route('BankAndDepDel', $department->id) }}">
                    							 	   {{ trans('global.delete') }}
                    							 	</a>
                                                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal" aria-label="Close" >
                                                        {{ trans('global.close') }}
                                                    </button>



                    				      		</div>
                    				    	</div>
                    				  	</div>
                    				</div>
            				
                                </div>
                            </div>
                        </div>
                    @else

                    @endif
                @endforeach
                
            @endforeach 
        @else
        @endif
    </div>
    {{ $departments->links() }}


@endsection

@section('script')
    <style type="text/css" media="screen">
		.modal-backdrop	{
			z-index: -3;
		}		
		.card-container, .front, .back
		{
		    height: 360px;
		}
	</style>
    <script>
        $(document).ready(function()
        {
            $(".depAmount").keypress(function(tecla)
            {
                if( tecla.charCode < 48 || tecla.charCode > 57) return false;
            });
        });
    </script>
@endsection