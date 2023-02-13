@extends('layouts.master')

@section('titolo')
{{ trans('labels.details') }} - {{ trans('labels.siteTitle') }}
@endsection

@section('stile', 'style.css')

@section('style')
<style>
    .jumbotron {
        background-image: url("{{ url('/') }}/img/home.png");
        background-size: cover;
    }
</style>
<script type="text/javascript" language="javascript" src="{{ url('/') }}/js/smooth.js"></script>
@endsection

@section('right_navbar')

@endsection

@section('breadcrumb')
<li><a href="{{ route('home') }}">Home</a></li>
<li><a class="active">{{ trans('labels.details') }}</a></li>
@endsection

@section('corpo')

<!-- Jumbotron -->
<div class="jumbotron">
  <h1 class="display-4" id="learnmore">{{ trans('labels.welcomeMessage') }}</h1>
  <p class="lead"><strong>Courseita</strong> {{ trans('labels.welcomeMessageSub') }}</p>
  <hr class="my-4">
</div><br>

<!-- Thumbnails -->
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="{{ url('/') }}/img/book_icon.png" alt="Thumbnail 1">
        <div class="caption">
          <h3><b>{{ trans('labels.joinUs') }}</b></h3>
          <p>{{ trans('labels.joinUsMessage') }}</p>
          <p><a href="#generalinfo" class="thumbnail-button">{{ trans('labels.findOutMore') }}</a></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="{{ url('/') }}/img/student_icon.png" alt="Thumbnail 2">
        <div class="caption">
          <h3><b>{{ trans('labels.becomeStudent') }}</b></h3>
          <p>{{ trans('labels.becomeStudentMessage') }}</p>
          <p><a href="#studentinfo" class="thumbnail-button" role="button">{{ trans('labels.findOutMore') }}</a></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="{{ url('/') }}/img/professor_icon.png" alt="Thumbnail 3">
        <div class="caption">
          <h3><b>{{ trans('labels.becomeProfessor') }}</b></h3>
          <p>{{ trans('labels.becomeProfessorMessage') }}</p>
          <p><a href="#professorinfo" class="thumbnail-button" role="button">{{ trans('labels.findOutMore') }}</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- General section -->
<section id="generalinfo">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="section-heading">{{ trans('labels.joinUs') }}</h2>
        <h3 class="section-subheading text-muted">{{ trans('labels.joinUsMessage') }}</h3>
        <p>
          {{ trans('labels.frontDetailsMessage1of1') }}
          <br>
          {{ trans('labels.frontDetailsMessage2of1') }}
        </p>
        <a class="btn btn-primary" href="{{ route('user.register') }}">{{ trans('labels.register') }}</a>
      </div>
      <div class="col-lg-6">
        <img src="{{ url('/') }}/img/home_logo.png" alt="Image">
      </div>
    </div>
  </div>
</section>

<!-- Student section -->
<section id="studentinfo">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <img src="{{ url('/') }}/img/home2.png" alt="Image">
      </div>
      <div class="col-lg-6">
        <h2 class="section-heading">{{ trans('labels.becomeStudent') }}</h2>
        <h3 class="section-subheading text-muted">{{ trans('labels.becomeStudentMessage') }}</h3>
        <p>
          {{ trans('labels.frontDetailsMessage1of2') }}
          <br>
          {{ trans('labels.frontDetailsMessage2of2') }}
        </p>
        <a class="btn btn-primary" href="{{ route('user.register') }}">{{ trans('labels.register') }}</a>
      </div>
    </div>
  </div>
</section>

<!-- Professor section -->
<section id="professorinfo">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="section-heading">{{ trans('labels.becomeProfessor') }}</h2>
        <h3 class="section-subheading text-muted">{{ trans('labels.becomeProfessorMessage') }}</h3>
        <p>
          {{ trans('labels.frontDetailsMessage1of3') }}
          <br>
          {{ trans('labels.frontDetailsMessage2of3') }}
        </p>
        <a class="btn btn-primary" href="{{ route('user.register') }}">{{ trans('labels.register') }}</a>
      </div>
      <div class="col-lg-6">
        <img src="{{ url('/') }}/img/home3.png" alt="Image">
      </div>
    </div>
  </div>
</section>


@endsection