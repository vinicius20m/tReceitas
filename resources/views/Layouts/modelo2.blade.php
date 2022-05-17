<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs       ================================================== -->
    <meta charset="utf-8">
    <title>Receitas</title>

    <!-- Mobile Specific Metas  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <!-- Favicon                ================================================== -->
    <link rel="icon" type="image/png" href="{{asset('constra/images/favicon.png')}}">

    <!-- CSS                    ================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('constra/plugins/bootstrap/bootstrap.min.css')}}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{asset('constra/plugins/fontawesome/css/all.min.css')}}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{asset('constra/plugins/animate-css/animate.css')}}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{asset('constra/plugins/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('constra/plugins/slick/slick-theme.css')}}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{asset('constra/plugins/colorbox/colorbox.css')}}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{asset('constra/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('constra/css/app.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


</head>

<body>
        <div class="body-inner">


                <div id="top-bar" class="top-bar">
                <div class="container">
                        {{-- <div class="row">
                        <div class="col-lg-8 col-md-8">
                                <ul class="top-info text-center text-md-left">
                                 <li><i class="fas fa-map-marker-alt"></i>
                                        <p class="info-text">Crie suas receitas agora</p>
                                </li>
                                </ul>
                        </div>
                        <!--/ Top info end -->
                        <!--/ Top social end -->
                        </div> --}}
                        <!--/ Content row end -->
                </div>
                <!--/ Container end -->
                </div>
                <!--/ Topbar end -->

                <!-- Header start -->
                <header id="header" class="header-two" style="background-color: #7858003b; padding-bottom: 6px; padding-top: 10px">
                <div class="site-navigation" style="background-color: #ebca76d1; box-shadow: 0px 10px 13px -7px #7a6730, 5px 5px 15px 5px rgb(118 100 49 / 42%)">
                        <div class="container">
                        <div class="row">
                                <div class="col-lg-12">
                                <nav class="navbar navbar-expand-lg navbar-light p-0">

                                        <div class="logo">

                                        </div><!-- logo end -->

                                        <a style="font-size: 30px; font-weight:600" class="navbar-brand" href="{{ url('/') }}">
                                                {{ config('app.name', 'Receitas') }}
                                        </a>

                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <div id="navbar-collapse" class="collapse navbar-collapse">
                                        <ul class="nav navbar-nav ml-auto align-items-center">
                                                @auth
                                                @if(Auth::user()->type != 'USER')
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{route('category')}}">Categorias</a>
                                                </li>
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{route('tag')}}">Tags</a>
                                                </li>
                                                @endif
                                                <li class="header-get-a-quote">
                                                        <a class="btn btn-primary" href="{{route('post-create')}}">Nova Receita</a>
                                                </li>
                                                @endauth
                                        </ul>
                                        <ul class="navbar-nav ms-auto" style="padding-left: 70px">
                                                <!-- Authentication Links -->
                                                @guest
                                                    @if (Route::has('login'))
                                                        <li class="nav-item">
                                                            <a class="nav-link" style="font-size: 11px" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                                                        </li>
                                                    @endif

                                                    @if (Route::has('register'))
                                                        <li class="nav-item">
                                                            <a class="nav-link" style="font-size: 11px" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                                        </li>
                                                    @endif
                                                @else
                                                    <li class="nav-item dropdown">
                                                        <a id="navbarDropdown" style="font-size: 11px" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                            {{ Auth::user()->name }}
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="navbarDropdown">

                                                                <a class="dropdown-item" style="font-size: 11px"
                                                                        href="{{ route('profile-show', Auth::user()->slug) }}"
                                                                >
                                                                Meu Perfil
                                                                </a>

                                                                <a class="dropdown-item" style="font-size: 11px" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                                                                        {{ __('Sair') }}
                                                                </a>

                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                        @csrf
                                                                </form>
                                                        </div>
                                                    </li>
                                                @endguest
                                            </ul>
                                        </div>
                                </nav>
                                </div>
                                <!--/ Col end -->
                        </div>
                        <!--/ Row end -->
                        </div>
                        <!--/ Container end -->

                </div>
                <!--/ Navigation end -->
                </header>
                <!--/ Header end -->

                <section id="main-container" class="main-container">
                        <div class="container">
                                <div class="row">

                                        @yield('content')
                                </div>
                        </div>
                </section>


                {{-- FOOTER START --}}

                <footer id="footer" class="footer bg-overlay">
                <div class="footer-main">
                        <div class="container">
                        <div class="row justify-content-between">
                                <div class="col-lg-4 col-md-6 footer-widget footer-about">
                                <h3 class="widget-title">Sobre Nós</h3>
                                <img loading="{{asset('lazy" class="footer-logo" src="constra/images/footer-logo.png" alt="')}}Constra">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inci done
                                        idunt ut
                                        labore et dolore magna aliqua.</p>
                                <div class="footer-social">
                                        <ul>
                                        <li><a href="" aria-label="Facebook"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="" aria-label="Twitter"><i
                                                        class="fab fa-twitter"></i></a>
                                        </li>
                                        <li><a href="" aria-label="Instagram"><i
                                                        class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://github.com/vinicius20m" aria-label="Github"><i
                                                        class="fab fa-github"></i></a></li>
                                        <li><a href="https://www.linkedin.com/in/vinicius-mendes-da-cruz-9bb09b229/" aria-label="Github"><i
                                                        class="fab fa-linkedin"></i></a></li>
                                        </ul>
                                </div><!-- Footer social end -->
                                </div><!-- Col end -->

                                <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
                                <h3 class="widget-title">Horários</h3>
                                <div class="working-hours">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inci done
                                        idunt ut
                                        labore et dolore magna aliqua.
                                        <br><br> Segunda - Sexta: <span class="text-right">9:00 - 21:00 </span>
                                        <br> Sábado: <span class="text-right">12:00 - 17:00</span>
                                        <br> Domingo e feriados: <span class="text-right">14:00 - 16:00</span>
                                </div>
                                </div><!-- Col end -->

                                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                                <h3 class="widget-title">Serviços</h3>
                                <ul class="list-arrow">
                                        <li><a href="">Receitas</a></li>
                                        <li><a href="">Culinarias</a></li>
                                        <li><a href="">Interassões Sociais</a></li>
                                        <li><a href="">Perfil de Usuário</a></li>
                                        <li><a href="">Consumo de API</a></li>
                                </ul>
                                </div><!-- Col end -->
                        </div><!-- Row end -->
                        </div><!-- Container end -->
                </div><!-- Footer main end -->

                <div class="copyright">
                        <div class="container">
                        <div class="row align-items-center">
                                <div class="col-md-12">
                                <div class="copyright-info text-center">
                                        <span>Copyright &copy;
                                        <script>
                                                document.write(new Date().getFullYear())
                                        </script>,Developed by <a
                                                href="https://www.linkedin.com/in/vinicius-mendes-da-cruz-9bb09b229/">Vinicius Mendes</a>
                                        </span>
                                </div>
                                </div>

                                <div class="col-md-12">
                                <div class="copyright-info text-center">
                                        <span>Projected by <a href="https://www.linkedin.com/in/vinicius-mendes-da-cruz-9bb09b229/">Vinicius Mendes</a></span>
                                </div>
                                </div>

                                <div class="col-md-12">
                                <div class="footer-menu text-center">
                                        <ul class="list-unstyled mb-0">
                                        <li><a href="">Sobre</a></li>
                                        <li><a href="">Nosso Pessoal</a></li>
                                        <li><a href="">Faq</a></li>
                                        <li><a href="">Blog</a></li>
                                        <li><a href="">Preços</a></li>
                                        </ul>
                                </div>
                                </div>
                        </div><!-- Row end -->

                        <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                                <button class="btn btn-primary" title="Back to Top">
                                <i class="fa fa-angle-double-up"></i>
                                </button>
                        </div>

                        </div><!-- Container end -->
                </div><!-- Copyright end -->
                </footer><!-- Footer end -->


                <!-- Javascript Files                   ================================================== -->

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

                <!-- initialize jQuery Library -->
                <script src="{{asset('constra/plugins/jQuery/jquery.min.js')}}"></script>
                {{-- <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script> --}}
                <!-- Bootstrap jQuery -->
                <script src="{{asset('constra/plugins/bootstrap/bootstrap.min.js')}}" defer></script>
                <!-- Slick Carousel -->
                <script src="{{asset('constra/plugins/slick/slick.min.js')}}"></script>
                <script src="{{asset('constra/plugins/slick/slick-animation.min.js')}}"></script>
                <!-- Color box -->
                <script src="{{asset('constra/plugins/colorbox/jquery.colorbox.js')}}"></script>
                <!-- shuffle -->
                <script src="{{asset('constra/plugins/shuffle/shuffle.min.js')}}" defer></script>


                <!-- Google Map API Key-->
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
                <!-- Google Map Plugin-->
                <script src="{{asset('constra/plugins/google-map/map.js')}}" defer></script>

                <!-- Template custom -->
                <script src="{{asset('constra/js/script.js')}}"></script>
                <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

                @yield('scripts')

        </div><!-- Body inner end -->
</body>

</html>
