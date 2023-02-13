@extends('layouts.master')

@section('titolo')
{{ trans('labels.personalArea') }} - {{ trans('labels.siteTitle') }}
@endsection

@section('stile', 'style.css')

@section('style')
<style>
    .jumbotron {
        background-image: url("{{ url('/') }}/img/home3.png");
        background-size: cover;
    }
</style>
@endsection


@section('breadcrumb')
<li><a class="active">{{ trans('labels.personalArea') }}</a></li>
@endsection

<!-- Home page for student -->
@section('corpo')
<!-- Jumbotron -->
<div class="jumbotron">
  <h1 class="display-4">{{ trans('labels.hello') }} <i>{{ $loggedName }}</i>, {{ trans('labels.welcomeBack') }}</h1>
  <p class="lead">
  </p>
</div>
<!-- List of courses taken by the student -->
@if($enrolledCourses->count() != 0)
<section class="bg-light py-5">
  <div class="container">
    <h2 class="text-center mb-5 ">{{ trans('labels.coursesListEnrolled') }}</h2>
    <h4 class="text-muted text-center mb-4">{{ trans('labels.coursesListSubtitle') }}</h4>
    <br><br>
    <div class="row mt-5">
      @foreach($enrolledCourses as $course)
        <div class="col-md-4 mb-4">
          <div class="card card-student h-100">
            <div class="card-body">
              <img src="{{ url('/') }}/img/course_icon.png" alt="course" class="card-img-top mx-auto d-block" style="width: 50px; height: 50px;">
              <h4 class="card-title text-center"><strong>{{ $course->title }}</strong></h4>
              <a href="{{ route('student.coursedetails', $course->id) }}" class="btn btn-primary btn-block mt-4">{{ trans('labels.details') }}</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    {{ $enrolledCourses->links('pagination.paginator') }}
  </div>
</section>
@else
<!-- No courses enrolled -->
<section class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
          <h4 class="text-center"><strong>{{ trans('labels.noCoursesStudent')}}</strong></h4><br>
          <a href="{{ route('student.researchcourse') }}" class="btn btn-success btn-block" style="justify-content: center; align-items: center;">{{ trans('labels.searchCourse')}}</a>
      </div>
    </div>
  </div>
</section>
@endif

@endsection