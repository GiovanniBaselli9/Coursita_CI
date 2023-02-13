<!DOCTYPE html>
<htm>
    <head>
        <meta charset="UTF-8">
        <title>{{ trans('labels.register') }} - {{ trans('labels.siteTitle')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/auth.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    </head>

    <!-- Registration -->
    <body>
        <div class="container">
            <div class="row" style="margin-top: 4em">
                <div class="col-md-6 col-md-offset-3">
                    <div class="tab-content">
                        <div>
                            <img src="{{ url('/') }}/img/logo-empty.png" alt="Home" class="img-responsive" style="margin: 0 auto; display: block; margin-top: 1em">
                        </div>

                        <div class="tab-pane active" id="login-form">
                            <!-- Registration form -->
                            <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em">
                                @csrf

                                <div class="form-group">
                                    <label for="user_type" class="control-label">{{ trans('labels.studentOrProfessor')}}: </label>
                                    <select class="form-control" name="user_type" id="user_type">
                                        <option value="student">{{ trans('labels.student') }}</option>
                                        <option value="professor">{{ trans('labels.professor') }}</option>
                                    </select>
                                </div>

                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group required">
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="" required/>
                                </div>
                                
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group required">
                                    <input type="text" name="email" class="form-control" aria-describedby="emailHelpBlock" placeholder="{{ trans('labels.email') }}" value="" required/>
                                    <small id="emailHelpBlock" class="form-text text-muted">
                                        {{ trans('labels.emailFormat') }} <strong>localport@domain</strong>.
                                    </small>
                                </div>
                                
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group required">
                                    <input type="password" name="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Password" value="" required/>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        {{ trans('labels.passwordFormat') }}
                                    </small>
                                </div>
                                
                                
                                @error('password-confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group required">
                                    <input type="password" name="password-confirmation" class="form-control" placeholder="{{ trans('labels.confirmPassword') }}" value="" required/>
                                </div>
                                

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" class="form-control btn btn-primary" value="{{ trans('labels.registerNow') }}">
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- Login redirect -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    {{ trans('labels.alreadyRegistered') }}
                                    <a href="{{ route('user.login') }}">{{ trans('labels.login') }}</a>
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

                    <br>
                </div>
            </div>
        </div>
    </body>
</htm>
