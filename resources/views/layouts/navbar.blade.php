@php
    use App\EvaluationHistory;
    use App\Wallet;
    use App\Product;
    use App\Bank;
    use App\Evaluation;
    $bank = Bank::where('id', 1)->first();
    $wallet = Wallet::where('id_user', Auth::user()->id)->value('amount');
    $evaluation = EvaluationHistory::where('date', date('m-Y'))->first();
@endphp



<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="0" id="sectionsNav">


    <div class="container">

        <div class="navbar-translate">
            <a class="navbar-brand" href="{{ route('home') }}">
                TOKENS PALM ERA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>


        <div class="collapse navbar-collapse" style="">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" aria-disabled="true" >
                        <span class="" style="vertical-align: middle;">
                            <img src="{{ asset('icons/tokens.png') }}" id="coin" alt="" style="width: 19px; height: 19px; margin: -4px 6px 0px 0px;">
                            <span class="h5 font-weight-light" style="font-size: 14px;">
                                {{ $wallet }}
                            </span>
                        </span>
                    </a>
                </li>
            @if(Auth::user()->type != 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="material-icons">
                                person_add
                            </i>
                            {{ trans('global.users') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">
                            <i class="material-icons">
                                add_shopping_cart
                            </i>
                            {{ trans('global.products') }}
                        </a>
                    </li>
            @else
            @endif

                <li class="dropdown nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="material-icons">
                            notifications
                        </i>
                        <span>
                            @if(count(Auth::user()->unreadNotifications) <= 0)
                                <sup style="display: none">{{count(Auth::user()->unreadNotifications)}}</sup>
                            @elseif(count(Auth::user()->unreadNotifications) > 0 && count(Auth::user()->unreadNotifications) <=  9)
                            <div class="bg-danger text-center" style="width: 14px; height: 14px; border-radius: 100%; display:inline-block; margin-left: -10px; padding-top: 3.5px;">
                                <sup style="font-size: 9px;color: #fff; vertical-align: middle; top: -7px;">{{count(Auth::user()->unreadNotifications)}}</sup>
                            </div>
                            @elseif(count(Auth::user()->unreadNotifications) > 9)
                            <div class="bg-danger text-center" style="width: 14px; height: 14px; border-radius: 100%; display:inline-block; margin-left: -10px; padding-top: 3.5px;">
                                <sup style="font-size: 9px;color: #fff; vertical-align: middle; top: -7px;">+9</sup>
                            </div>
                            @endif
                        </span>
                    </a>

                    <div class="dropdown-menu card dropdown-with-icons force-scroll contenedor text-center" onclick="return getNotification()" style="min-width: 200px; max-height: 600px; margin-top: 0px;">
                        <style>
                            .need:hover
                            {
                                background-color: #fff !important;
                                box-shadow: none !important;
                                filter: contrast(100%);
                            }
                        </style>
                        <a href="{{ route('maskAsRead') }}" class="need text-center" style="margin: 0px; padding: 6px; display: inline-block; width: 36.77px; float: left; border-radius: 100%; color: #6c757d;">
                            <i class="material-icons">
                                visibility
                            </i>
                            {{-- {{ trans('global.markAllAsRead') }} --}}
                        </a>
                        <a href="{{ route('deleteNotifications') }}" class="need text-center" style="margin: 0px; padding: 6px; display: inline-block; width: 36.77px; float: right; border-radius: 100%; color: #ff6156;">
                            <i class="material-icons">
                                delete_forever
                            </i>
                            {{-- {{ trans('global.deleteAll') }} --}}
                        </a>
                        @php
                            use App\User;
                            $users = User::get();
                            $walletsC = Wallet::get();
                            $productsC = Product::get();
                        @endphp
                        @foreach (Auth::user()->notifications as $notification)
                            {{-- 
                                Notificaciones de productos añadidos
                             --}}
                            @if($notification->data['type'] == "product_added")
                                <div class="dropdown-item text-truncate" style="margin: 0px;" data-toggle="modal" data-target="#modalProductAdded{{ $notification->data["product_id"] }}">
                                    <i class="material-icons">
                                        add_shopping_cart
                                    </i>
                                    <span>
                                        {{ trans('global.newProduct') }}
                                    </span>
                                </div>
                            {{-- 
                                Notificaciones de solicitud de compra
                             --}}
                            @elseif($notification->data['type'] == "request")
                                <div class="dropdown-item text-truncate" style="margin: 0px;" data-toggle="modal" data-target="#modalPurchaseRequest{{ $notification->data["product_id"].$notification->data["product_name"] }}">
                                    <i class="material-icons">
                                        style
                                    </i>
                                    @foreach($users as $user)
                                        @if($user->id == $notification->data['user'])
                                            {{ trans('<global class="purchase"></global>') }}
                                        @else
                                        @endif
                                    @endforeach{{-- 

                                         <form action="{{ route('purchaseAccepted') }}" method="post" accept-charset="utf-8" class="form-inline" style="position: absolute; right: 26.5px; bottom: 12px;">
                                            <input type="hidden" name="notification" value="{{ $notification->id }}">
                                            <input type="hidden" name="user" value="{{ $notification->data['user'] }}">
                                            <input type="hidden" name="product" value="{{ $notification->data['product_id'] }}">
                                            <input type="hidden" name="admin" value="{{ $notification->data['admin'] }}">
                                            @php
                                                $product = Product::where('id', $notification->data['product_id'])->first();
                                            @endphp
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input type="hidden" name="wallet" value="{{ $wallet }}">
                                            <input type="hidden" name="bank" value="{{ $bank->amount }}">
                                            <input type="hidden" name="" value="">
                                            @foreach($walletsC as $walletC)
                                                @if($walletC->id_user ==  $notification->data['user'])
                                                    @foreach($productsC as $productC)
                                                        @if($productC->id == $notification->data['product_id'])
                                                            @if($walletC->amount >= $productC->price)
                                                                <button type="submit" class="btn btn-info btn-sm" style="margin: 0 2.5px 0 0; padding: 0; width: 25px; height: 25px;" style="vertical-align: middle;">
                                                                    <i class="material-icons" style="margin: 0;">
                                                                        done
                                                                    </i>
                                                                </button>
                                                            @else
                                                                <button type="submit" class="btn btn-default btn-sm" disabled style="margin: 0 2.5px 0 0; padding: 0; width: 25px; height: 25px;" style="vertical-align: middle;">
                                                                    <i class="material-icons" style="margin: 0;">
                                                                        done
                                                                    </i>
                                                                </button>

                                                            @endif
                                                        @else

                                                        @endif
                                                    @endforeach
                                                @else

                                                @endif
                                            @endforeach
                                            
                                        </form> 
                                    <i>
                                        <form action="{{ route('purchaseRejected') }}" method="post" accept-charset="utf-8" class="form-inline" style="position: absolute; right: 0; bottom: 12px;">
                                            <input type="hidden" name="user" value="{{ $notification->data['user'] }}">
                                            <input type="hidden" name="notification"  value="{{ $notification->id }}">        
                                            <button type="submit" class="btn btn-danger btn-sm" style="margin: 0 0 0 2.5px; padding: 0; width: 25px; height: 25px;">
                                                <i class="material-icons" style="margin: 0;">
                                                    clear
                                                </i>
                                            </button>
                                        </form>
                                    </i>--}}
                                </div>
                            {{-- 
                                Notificaciones de compra rechazada
                             --}}
                            @elseif($notification->data['type'] == "rejected")
                                <div class="dropdown-item" data-toggle="tooltip" data-placement="left" title="" style="margin: 0px;">
                                    <i class="material-icons">
                                        sentiment_very_dissatisfied
                                    </i>
                                    <span>
                                        {{ trans('global.reject') }}
                                    </span>
                                </div>
                            {{-- 
                                Notificaciones de compra aceptada
                             --}}
                            @elseif($notification->data['type'] == "accepted")
                                <div class="dropdown-item" data-toggle="tooltip" data-placement="left" title="" style="margin: 0px">
                                    <i class="material-icons">
                                        sentiment_satisfied_alt
                                    </i>
                                    <span>
                                        {{ trans('global.accept') }}
                                    </span>
                                </div>
                            {{-- 
                                Notificaciones de usuario registrado
                             --}}
                            @elseif($notification->data['type'] == "user_registered")
                                <div class="dropdown-item" style="margin: 0px">
                                    <i class="material-icons">
                                        person_add
                                    </i>
                                    <span>
                                        {{ trans('global.newUser') }}
                                    </span>
                                </div>
                            @elseif($notification->data['type'] == "rewardRequest")
                                <div class="dropdown-item" data-toggle="tooltip" data-placement="left" title="" style="margin: 0px">
                                    <i class="material-icons">
                                        emoji_events
                                    </i>
                                    <form action="" method="post" accept-charset="utf-8" class="form-inline" style="position: absolute; right: 26.5px; bottom: 12px;">
                                        <button type="submit" class="btn btn-default btn-sm" disabled style="margin: 0 2.5px 0 0; padding: 0; width: 25px; height: 25px;" style="vertical-align: middle;">
                                            <i class="material-icons" style="margin: 0;">
                                                done
                                            </i>
                                        </button>
                                        </form>
                                    <i>
                                        <form action="" method="post" accept-charset="utf-8" class="form-inline" style="position: absolute; right: 0; bottom: 12px;">
                                            <button type="submit" class="btn btn-danger btn-sm" style="margin: 0 0 0 2.5px; padding: 0; width: 25px; height: 25px;">
                                                <i class="material-icons" style="margin: 0;">
                                                    clear
                                                </i>
                                            </button>
                                        </form>
                                    </i> 
                                </div>
                            @elseif($notification->data['type'] == "reward_rejected")
                                <div class="dropdown-item" data-toggle="tooltip" data-placement="left" title="New users registered" style="margin: 0px">
                                    <i class="material-icons">
                                        sentiment_very_dissatisfied
                                    </i>
                                    <span>
                                        {{ $notification->data['name']." ".$notification->data['last_name'] }}
                                    </span>
                                </div>
                            @elseif($notification->data['type'] == "reward_accepted")
                                <div class="dropdown-item" data-toggle="tooltip" data-placement="left" title="New users registered" style="margin: 0px">
                                    <i class="material-icons">
                                        sentiment_satisfied_alt
                                    </i>
                                    <span>
                                        {{ $notification->data['name']." ".$notification->data['last_name'] }}
                                    </span>
                                </div>
                            @else
                            @endif
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    @php
                        $_lang = session()->get('lang');
                    @endphp
                    @if($_lang == 'en')
                        <a href="{{ route('change_lang', ['lang' => 'es']) }}" class="nav-link">
                            <img src="{{ asset('icons/es.svg') }}" width="30px" style="">
                        </a>
                    @elseif($_lang == 'es')
                        <a href="{{ route('change_lang', ['lang' => 'en']) }}" class="nav-link">
                            <img src="{{ asset('icons/en.svg') }}" width="30px" style="">
                        </a>
                    @else

                    @endif
                </li>
                <li class="dropdown nav-item">
                    <a href="" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ asset('public/avatar/'.Auth::user()->img) }}" class="img-raised" style="width: 22px; height: 22px; border-radius: 100%; margin-right: 5px; border: double #A569BD 1px;">
                        {{ Auth::user()->name }} 
                    </a>                    
                    <div class="dropdown-menu dropdown-with-icons">
                        @if(Auth::user()->type == True)
                            <a class="dropdown-item text-uppercase" href="{{ route('statistics') }}">
                                <i class="material-icons">
                                    timeline

                                </i>
                                {{ trans('global.statistics') }}
                            </a>
                        @else
                        @endif
                        @php
                            try
                            {
                                //
                                Evaluation::get();
                        @endphp
                        @if( Auth::user()->name == "JC" || Auth::user()->type == 2 )
                            <a href="{{ route('evaluate') }}" class="dropdown-item text-uppercase">
                                <i class="material-icons">
                                    list_alt
                                </i>
                                {{ trans('global.evaluate') }}
                            </a>
                        @else
                        @endif
                        @php
                            }
                            catch (Exception $e)
                            {
                                //
                            }
                        @endphp
                        @if(Auth::user()->type == 3)
                            <a href="{{ route('bank') }}" class="dropdown-item text-uppercase">
                                <i class="material-icons">
                                    account_balance
                                </i>
                                {{ trans('global.department').'s' }}
                            </a>
                        @endif

                        @if(Auth::user()->type == 3)
                            <a class="dropdown-item text-uppercase text-truncate" href="{{ route('groups') }}">
                                <i class="material-icons">
                                    group
                                </i>
                                {{ trans('global.evaluationGroup') }}
                            </a>
                        @else

                        @endif

                        @if(Auth::user()->type != 1)
                            <a href="{{ route('reward') }}" class="dropdown-item text-uppercase ">
                                <i class="material-icons">
                                    emoji_events
                                </i>
                                {{ trans('global.reward') }}
                            </a>
                        @endif
                        <a href="{{ route('administrator') }}" class="dropdown-item text-uppercase">
                            <i class="material-icons">supervised_user_circle</i>Administrador
                        </a>
                        <a href="{{ route('question') }}" class="dropdown-item text-uppercase">
                            <i class="material-icons">help</i>Questions
                        </a>
                        {{-- <a href="{{ route('carousel') }}" class="dropdown-item text-uppercase">
                            <i class="material-icons">add_photo_alternate</i>
                            Slider
                        </a> --}}
                        <a href="{{ route('wallet') }}" class="dropdown-item text-uppercase">
                            <i class="material-icons">credit_card</i>
                            {{ trans('global.wallet') }}
                        </a>
                        <a class="dropdown-item text-uppercase" href="{{ route('profile') }}">
                            <i class="material-icons">
                                face
                            </i>
                            {{ trans('global.acount') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-uppercase" data-toggle="modal" data-target="#logoutModal">
                            <i class="material-icons">
                                input
                            </i>
                            {{ trans('global.logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


        {{-- Modals --}}

    {{-- Modal Logout --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="col-md-8 modal-content text-center ml-auto mr-auto">
                <div class="modal-header">
                    <h6 class="h3 text-uppercase ml-auto mr-auto" id="exampleModalLabel">{{ trans('global.logout') }}</h6>
                </div>
                <div class="modal-body">
                    {{ trans('global.logoutConf') }}
                </div>
                <div class="modal-footer text-center" style="padding-left: 0px; padding-right: 0px;">
                    <a class="btn btn-primary text-uppercase ml-auto mr-auto" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ trans('global.logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

@foreach (Auth::user()->notifications as $notification)
    
    {{-- Modal Product Added --}}
    @if($notification->data['type'] == "product_added")
    
        <div class="modal fade" id="modalProductAdded{{ $notification->data["product_id"] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content col-md-8 ml-auto mr-auto">
                    <div class="modal-header">
                        <h6 class="h3 text-uppercase ml-auto mr-auto" id="exampleModalLabel">{{ $notification->data["product"] }}</h6>
                    </div>
                    <div class="modal-body text-center">
                        <p class="card-text" style="vertical-align: middle;">
                            <img src="{{ asset('icons/tokens.svg') }}" width="19px" style="margin: -10px 5px 0px 0px;">
                            <span class="h4">{{ $notification->data["price"] }}</span>
                        </p>
                        <p>
                            
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('global.close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- Modal Product Request Purchase --}}
    @elseif($notification->data['type'] == "request")
    
        <div class="modal fade" id="modalPurchaseRequest{{ $notification->data["product_id"].$notification->data["product_name"] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content col-md-8 ml-auto mr-auto">
                    <div class="modal-header">
                        <h6 class="h3 text-uppercase ml-auto mr-auto" id="exampleModalLabel">{{ $notification->data["product_name"] }}</h6>
                    </div>
                    <div class="modal-body text-center">
                        <p class="card-text" style="vertical-align: middle;">
                            @foreach($users as $user)
                                @if($user->id == $notification->data['user'])
                                    {{ $user->name." ".trans('global.wantPurchaseProduct') }}
                                @else
                                @endif
                            @endforeach
                        </p>
                        <p>
                            
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('purchaseAccepted') }}" method="post" accept-charset="utf-8" class="form-inline" style="">
                            <input type="hidden" name="notification" value="{{ $notification->id }}">
                            <input type="hidden" name="user" value="{{ $notification->data['user'] }}">
                            <input type="hidden" name="product" value="{{ $notification->data['product_id'] }}">
                            <input type="hidden" name="admin" value="{{ $notification->data['admin'] }}">
                            @php
                                $product = Product::where('id', $notification->data['product_id'])->first();
                            @endphp
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="wallet" value="{{ $wallet }}">
                            <input type="hidden" name="bank" value="{{ $bank->amount }}">
                            <input type="hidden" name="" value="">
                            @foreach($walletsC as $walletC)
                                @if($walletC->id_user ==  $notification->data['user'])
                                    @foreach($productsC as $productC)
                                        @if($productC->id == $notification->data['product_id'])
                                            @if($walletC->amount >= $productC->price)
                                                <button type="submit" class="btn btn-info ml-auto mr-auto " style="margin-bottom: -18px;">
                                                    {{ trans('global.accept') }}
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-default ml-auto mr-auto" disabled style="margin-bottom: -18px;">
                                                    {{ trans('global.accept') }}
                                                </button>

                                            @endif
                                        @else

                                        @endif
                                    @endforeach
                                @else

                                @endif
                            @endforeach
                            
                        </form>


                        <i>
                            <form action="{{ route('purchaseRejected') }}" method="post" accept-charset="utf-8" class="" style="">
                                <input type="hidden" name="user" value="{{ $notification->data['user'] }}">
                                <input type="hidden" name="notification"  value="{{ $notification->id }}">        
                                <button type="submit" class="btn btn-danger ml-auto mr-auto" style="margin-bottom: -18px;">
                                    {{ trans('global.reject') }}
                                </button>
                            </form>
                        </i>
                        <button type="button" class="btn btn-default ml-auto mr-auto" data-dismiss="modal">{{ trans('global.close') }}</button>
                    </div>
                </div>
            </div>
        </div>

    
    @else

    @endif

@endforeach




{{-- End Modals --}}