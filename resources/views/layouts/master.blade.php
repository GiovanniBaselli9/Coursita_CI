<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('titolo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
    @yield('style')
    <!-- jQuery e plugin JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="{{ url('/') }}/js/MyScript.js"></script>
    <script type="text/javascript" language="javascript" src="{{ url('/') }}/js/scrollbar.js"></script>
</head>

<body>
    <!-- Progress bar -->
    <div id="progress-container">
        <div id="progress-bar"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar-default">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-left" title="Home">
                <img src="{{ url('/') }}/img/logo.png" class="img-fluid align-top" alt="Home" width=180>
            </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="myNavbar">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if($logged)
                    @if($user_type == 'professor')
                    <li><a href="{{ route('professor.researchcourse') }}"><span class="glyphicon glyphicon-search"></span> {{ trans('labels.searchCourse')}}</a></li>
                    @else 
                    <li><a href="{{ route('student.researchcourse') }}"><span class="glyphicon glyphicon-search"></span> {{ trans('labels.searchCourse')}}</a></li>
                    @endif
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    
                    @if($logged)
                    <li><a style="color: #0a0683a4;"><i>{{ trans('labels.welcome') }}, {{ $loggedName }}</i></a></li>
                    @if($user_type == 'professor')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ trans('labels.profile') }}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('professor.index') }}"><span class="glyphicon glyphicon-pushpin"></span> {{ trans('labels.personalArea') }}</a></li>
                            <li><a href="{{ route('professor.settings') }}"><span class="glyphicon glyphicon-wrench"></span> {{ trans('labels.settings') }}</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ trans('labels.profile') }}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('student.index') }}"><span class="glyphicon glyphicon-pushpin"></span> {{ trans('labels.personalArea') }}</a></li>
                            <li><a href="{{ route('student.settings') }}"><span class="glyphicon glyphicon-wrench"></span> {{ trans('labels.settings') }}</a></li>
                        </ul>
                    </li>
                    @endif
                    <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span class="glyphicon glyphicon-log-out"></span></a></li>
                    @else
                    <li><a href="{{ route('user.login') }}"><span class="glyphicon glyphicon-user"></span> {{ trans('labels.login') }}</a></li>
                    <li><a href="{{ route('user.register') }}"><span class="glyphicon glyphicon-book"></span> {{ trans('labels.register') }}</a></li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"></span><span class="glyphicon glyphicon-globe"></span> {{ trans('labels.language') }}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('setLang', ['lang' => 'en']) }}" class="nav-link">EN</a></li>
                            <li><a href="{{ route('setLang', ['lang' => 'it']) }}" class="nav-link">IT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container">
        <ul class="breadcrumb pull-right">
            @yield('breadcrumb')
        </ul>
    </div>

    <!-- Site title -->
    <div class="container">
        <header class="header-sezione">
            <h1>
                {{ trans('labels.siteTitle') }}
            </h1>
            
        </header>
    </div>

    @yield('corpo')
    
    <!-- Personal Area redirect -->
    @if($logged)
    @if($user_type == 'professor')
    <a href="{{ route('professor.index') }}"><img src="{{ url('/') }}/img/professor_icon.png" alt="Image 3" class="cloud" title="{{ trans('labels.personalArea') }}"></a>
    @elseif($user_type == 'student')
    <a href="{{ route('student.index') }}"><img src="{{ url('/') }}/img/student_icon.png" alt="Image 3" class="cloud" title="{{ trans('labels.personalArea') }}"></a>
    @endif
    @endif

    <!-- Footer -->
    <footer class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-uppercase"><b>{{ trans('labels.aboutUs')}}</b></h5>
                    <p>Courseita {{ trans('labels.welcomeMessageSub') }}</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase"><b>{{ trans('labels.links') }}</b></h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('details') }}">{{ trans('labels.details') }}</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase"><b>{{ trans('labels.contacts') }}</b></h5>
                    <ul class="list-unstyled">
                        <li><span class="glyphicon glyphicon-earphone"></span> {{ trans('labels.phone') }}: (+39) 3334567891</li>
                        <li><span class="glyphicon glyphicon-envelope"></span> Email: info@courseita.it</li>
                        <li><span class="glyphicon glyphicon-globe"></span> {{ trans('labels.address') }}: Via Coursita 5, Brescia (BS)</li>
                    </ul>
                </div>
            </div>
            <div class="text-center py-3">
                <p>Copyright &copy; 2023.</p>
            </div>
        </div>
    </footer>


</body>

</html>