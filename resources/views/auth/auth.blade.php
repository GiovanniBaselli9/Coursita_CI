<!DOCTYPE html>
<htm>
    <head>
        <meta charset="UTF-8">
        <title>{{ trans('labels.login') }} - {{ trans('labels.siteTitle')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/auth.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    </head>

    <!-- Login -->
    <body>
        <div class="container">
            <div class="row" style="margin-top: 4em">
                <div class="col-md-6 col-md-offset-3">
                    <div class="tab-content">
                        <div>
                        <img src="{{ url('/') }}/img/logo-empty.png" alt="Home" class="img-responsive" style="margin: 0 auto; display: block; margin-top: 1em">
                        </div>

                        <!-- Login form -->
                        <div class="tab-pane active" id="login-form">
                            <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em">
                                @csrf

                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ trans('labels.invalidLogin') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Username"/>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                                </div>

                                <div id="warning"></div>

                                <div class="form-group">
                                    <label for="user_type" class="control-label">{{ trans('labels.user_type') }}:</label>
                                    <select class="form-control" name="user_type" id="user_type">
                                        <option value="student">{{ trans('labels.student') }}</option>
                                        <option value="professor">{{ trans('labels.professor') }}</option>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" class="form-control btn btn-primary" value="{{ trans('labels.login') }}">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

        </div>
        
        <!-- Register redirect -->
        <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            {{ trans('labels.noAccount') }}
                            <a href="{{ route('user.register') }}">{{ trans('labels.register') }}</a>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Home redirect -->
        <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a href="{{ route('home') }}" class="btn btn-success" style="margin: 0 auto; margin-top: 2em">Home</a>
                        </div>
                    </div>
        </div>

    </body>
</htm>