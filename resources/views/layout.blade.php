<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ReMo</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--meta name="csrf-token" content="{{ csrf_token() }}"-->

        <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->  

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery-ui.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/timepicki.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/custom.css') }}">  

        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-3.2.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>  
        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>  
        <script type="text/javascript" src="{{ URL::asset('assets/js/timepicki.js') }}"></script>

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        ReMo (Registro de Movimientos)
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Bienvenido {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/user/reset/{{ Auth::user()->id }}">Cambiar contraseña</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li> 
                                                                       
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>                
            </div>
        </nav>        
    </head>
    <body>
        @if(Auth::check())
            @if(Auth::user()->isAdmin)
                @include('adminDB')
            @else
                @include('regularDB')
            @endif
        @endif

        <div class="row">
            <div class="col-md-2">
                @yield('sidebar')    
            </div>
            @yield('modal-delete')
            @yield('modal-edit')
            @yield('modal-info')
            <div class="col-md-6 col-md-offset-1">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok-sign"></span><em> {!! session('flash_message') !!}</em></div>
                @endif
                @if(Session::has('flash_message_not'))
                    <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span><em> {!! session('flash_message_not') !!}</em></div>
                @endif
                @if(Session::has('flash_message_info'))
                    <div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span><em> {!! session('flash_message_info') !!}</em></div>
                @endif
            </div>
            <div class=" container col-md-10">
                @yield('content')    
            </div>            
        </div>        
        <div class="container col-md-10 col-md-offset-1">
            @yield('login')          
        </div>
       
        @yield('table')

        <div class="container col-md-11 col-md-offset-1">
            @yield('form')
        </div>
        @yield('script')
        <script type="text/javascript">
            $(document).ready(function(){
                setTimeout(function() {
                  $('.alert').fadeOut('fast');
                }, 5000); 
            });
        </script>
        
    </body>
</html>
