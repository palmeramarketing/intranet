<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
            <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
            <link href="{{ asset('assets/css/material-kit.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/css/rotating-card.css') }}" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/animations.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/fSelect/fSelect.css') }}">
            <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
            <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
            <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
            <script>
                var textSearch = "{{ trans('global.search') }}";
                var usersPlaceholder = "{{ trans('global.users') }}";
                var SelectedTrans = "{{ trans('global.selected') }}";
                var noRF = "{{ trans('global.noRF') }}";
            </script>
            <script src="{{ asset('assets/fSelect/fSelect.js') }}" ></script>
            @yield('stylesheet')
            <title>TOKENS - @yield('title')</title>
        </head>
        <body>
            <div class="container-loader" id="container-loader">
                <div class="loader">
                    
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show text-center col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4 text-uppercase pAlert" role="alert" data-dismiss="alert" aria-label="Close" style="position: fixed; bottom: 0px; z-index: 1500; right: 0px; margin: 0px;">
                        @foreach($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show text-center col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4 text-uppercase pAlert" role="alert" data-dismiss="alert" aria-label="Close" style="position: fixed; bottom: 0px; z-index: 1500; right: 0px; margin: 0px;">
                    <span>{{ trans('global.'.Session::get('success')) }}</span>
                </div>
            @endif
            @if(Session::has('danger'))
                <div class="alert alert-danger alert-dismissible fade show text-center col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4 text-uppercase pAlert" role="alert" data-dismiss="alert" aria-label="Close" style="position: fixed; bottom: 0px; z-index: 1500; right: 0px; margin: 0px;">
                    <span>{{ trans('global.'.Session::get('danger')) }}</span>

                </div>
            @endif
            @yield('navbar')
            @yield('content')
            <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
            <script async defer src="https://buttons.github.io/buttons.js"></script>
            <script src="{{ asset('assets/js/material-kit.js') }}" type="text/javascript"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.2/dist/Chart.min.js" type="text/javascript"></script>
            <script src="{{ asset('js/layout.js') }}"></script>
            <script src="{{ asset('js/loader.js') }}"></script>
            @yield('script')
        </body>
    </html>