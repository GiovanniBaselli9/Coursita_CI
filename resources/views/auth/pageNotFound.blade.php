<!DOCTYPE html>
<htm>
    <head>
        <meta charset="UTF-8">
        <title>{{ trans('labels.pageNotFound') }} - {{ trans('labels.siteTitle') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    </head>
    
    <!-- Card for page not found -->
    <body style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="card" style="background-color: #ff9999; border-radius: 10px;">
            <div class="card-header" style="color: red; text-align: center;">
            <span class="glyphicon glyphicon-warning-sign"></span>
            </div>
            <div class="card-body" style="text-align: center;">
            <p style="color: black; font-size: 20px;">{{ trans('labels.pageNotFound') }}</p>
            <a class="btn btn-danger" href="javascript:history.back()">{{ trans('labels.back')}}</a>
            </div>
        </div>
    </body>



</htm>