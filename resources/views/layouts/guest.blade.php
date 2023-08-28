<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
    <link href="{{ asset('lib/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">

    <!-- JS -->    
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>    
    <script src="{{asset('template/plugins/popper/popper.min.js')}}"></script>    
    <script src="{{asset('template/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{asset('template/dist/js/adminlte.js')}}"></script>
    <script src="{{asset('template/dist/js/adminlte.min.js')}}"></script>

</head>

<body class="d-flex flex-column min-vh-100">
    <section class="content">
        <div class="container-fluid">
            <!-- Brand Start -->
            <div class="brand" >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4">
                            <div class="b-logo">
                                <a href="{{url('/')}}">
                                    <img src="{{asset('asset/undip-digital-logo.png')}}" alt="Logo">
                                    {{-- <span class="brand-text font-weight-light"><h3>Undip Digital</h3></span> --}}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4">
                            <div class="b-ads">

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="b-search">
                                <input type="text" placeholder="Search">
                                <button><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Brand End -->

            <!-- Nav Bar Start -->
            <div class="nav-bar" >
                <div class="container">
                    <div class="navbar navbar-expand-md bg-dark navbar-dark" style="background-color: #10144c">
                        <a href="#" class="navbar-brand">MENU</a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto">
                                <a href="{{route('guest.home')}}" class="nav-item nav-link">Home</a>
                                <a href="{{route('guest.ebook.index')}}" class="nav-item nav-link">Ebook</a>
                                <a href="{{route('guest.ejournal.index')}}" class="nav-item nav-link">Ejournal</a>
                                <a href="{{route('guest.pamflet.index')}}" class="nav-item nav-link">Pamflet</a>
                            </div>
                            <div class="navbar-nav float-right">
                                <a href="{{route('login')}}" class="nav-item nav-link">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nav Bar End -->
            @yield('content')
        </div>
    </section>

    <!-- Footer Bottom Start -->
    <div class="footer-bottom mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6 copyright">
                    <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
                </div>

                <div class="col-md-6 template-by">
                    <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</body>