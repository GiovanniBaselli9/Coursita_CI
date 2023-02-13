@extends('layouts.master')

@section('titolo')
{{ trans('labels.studentDetails') }} - {{ trans('labels.siteTitle') }}
@endsection

@section('stile', 'style.css')

@section('style')
<style>
    .jumbotron {
        background-image: url("{{ url('/') }}/img/home2.png");
        background-size: cover;
    }
</style>
@endsection

@section('breadcrumb')
<li><a href="{{ route('professor.index') }}">{{ trans('labels.personalArea') }}</a></li>
<li><a class="active">{{ trans('labels.studentDetails') }}</a></li>
@endsection

@section('corpo')
<!-- Jumbotron -->
<div class="jumbotron">
  <h1 class="display-4">{{ trans('labels.studentDetails') }} - <i>{{ $student->username }}</i></h1>
</div>

<!-- Student details -->
<div class="container my-5 text-center">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card mx-auto card-professor">
        <img class="card-img-top mx-auto d-block" src="{{ url('/') }}/img/student_icon.png" alt="Student Image" style="width: 100px; height: 100px;">
        <div class="card-body">
          <h1 class="card-title mb-5">{{ $student->username }}</h1>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 mx-auto">
              @if($student->name!=null) <p class="font-weight-bold"><strong>{{ trans('labels.name') }}:</strong> {{ $student->name }}</p> @endif
              @if($student->surname!=null)<p class="font-weight-bold"><strong>{{ trans('labels.surname') }}:</strong> {{ $student->surname }}</p> @endif
              <p class="font-weight-bold"><strong>Username:</strong> {{ $student->username }}</p>
              <p class="font-weight-bold"><strong>Email:</strong> {{ $student->email }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Courses list for this student -->
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <h2 class="mt-5 mb-5">{{ trans('labels.coursesList') }}</h2>
    <h5 class="text-muted text-center mb-4">{{ trans('labels.listCoursesStudent') }}</h5>
    <br>
      <ul class="list-group list-group-flush">
        @foreach($student->courses as $course)
          <li class="list-group-item text-center rounded">
            <a href="{{ route('professor.coursedetails', $course->id) }}">{{ $course->title }}</a>
          </li>
        @endforeach
      </ul>
      <a href="javascript:history.back()" class="btn btn-success mt-5">{{ trans('labels.back') }}</a>
  </div>
</div>
</div>

@endsection