@extends('layouts.master')

@section('titolo')
@lang('labels.siteTitle')
@endsection

@section('stile', 'style.css')

@section('style')
<link rel="stylesheet" href="{{ url('/') }}/css/slideshow.css">
@endsection

@section('right_navbar')

@endsection

@section('breadcrumb')
<li><a class="active">Home</a></li>
@endsection

@section('corpo')
<!-- Slideshow container -->
<div id="slider">
  <div class="slide">
    <img src="{{ url('/') }}/img/home_logo.png" alt="Image 1">
    <div class="caption">
      <h3><strong>{{ trans('labels.welcomeMessage') }}</strong></h3>
      <p><strong>Courseita</strong> {{ trans('labels.welcomeMessageSub') }}</p>
    </div>
  </div>
  <div class="slide">
    <img src="{{ url('/') }}/img/home2.png" alt="Image 2">
    <div class="caption">
      <h3><strong>{{ trans('labels.becomeProfessor') }}</strong></h3>
      <p>{{ trans('labels.becomeProfessorMessage') }}</p>
    </div>
  </div>
  <div class="slide">
    <img src="{{ url('/') }}/img/home3.png" alt="Image 3">
    <div class="caption">
      <h3><strong>{{ trans('labels.becomeStudent') }}</strong></h3>
      <p>{{ trans('labels.becomeStudentMessage') }}</p>
      <a href="{{ route('user.register') }}" class="slider-btn">{{ trans('labels.subscribeNow') }}</a>
    </div>
  </div>
  <button id="prevBtn"><span class="glyphicon glyphicon-chevron-left"></span></button>
  <button id="nextBtn"><span class="glyphicon glyphicon-chevron-right"></span></button>
</div>
<script src="{{ url('/') }}/js/slideshow.js"></script>

<!-- Jumbotron -->
<div class="jumbotron" style="background-image: url('{{ url('/') }}/img/home.png'); background-size: cover; margin-top: 80px;">
  <h1 class="display-4" id="learnmore">{{ trans('labels.welcomeMessage') }}</h1>
  <p class="lead"><strong>Courseita</strong> {{ trans('labels.welcomeMessageSub') }}</p>
  <hr class="my-4">
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="{{ route('details') }}" role="button">{{ trans('labels.findOutMore') }}</a>
  </p>
</div>

<!-- Reviews -->
<section id="reviews">
  <div class="container">
    <h2><b>{{ trans('labels.ourReviews') }}</b></h2>
    <p>{{ trans('labels.ourReviewsMessage') }}</p>
    <br>
      <div class="row">
        <div class="col-md-4">
          <div class="review-box">
            <img src="{{ url('/') }}/img/professor.jpg" alt="reviewer-image" class="reviewer-image">
            <p class="reviewer-caption">
            {{ trans('labels.review1') }}
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-box">
            <img src="{{ url('/') }}/img/student_girl.jpg" alt="reviewer-image" class="reviewer-image">
            <p class="reviewer-caption">
            {{ trans('labels.review2') }}
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-box">
            <img src="{{ url('/') }}/img/student_boy.jpg" alt="reviewer-image" class="reviewer-image">
            <p class="reviewer-caption">
            {{ trans('labels.review3') }}
            </p>
          </div>
        </div>
    </div>
  </div>
</section>

@endsection