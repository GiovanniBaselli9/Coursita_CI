@extends('layouts.master')

@section('titolo')
{{ trans('labels.professorDetails') }} - {{ trans('labels.siteTitle') }}
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
<li><a href="{{ route('student.index') }}">{{ trans('labels.personalArea') }}</a></li>
<li><a class="active">{{ trans('labels.professorDetails') }}</a></li>
@endsection

@section('corpo')
<!-- Jumbotron -->
<div class="jumbotron">
  <h1 class="display-4">{{ trans('labels.professorDetails') }} - <i>{{ $professor->username }}</i></h1>
  <p class="lead">
  </p>
</div>
<!-- Professor details -->
<div class="container my-5 text-center">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card mx-auto card-student">
        <img class="card-img-top mx-auto d-block" src="{{ url('/') }}/img/professor_icon.png" alt="Professor Image" style="width: 100px; height: 100px;">
        <div class="card-body">
          <h1 class="card-title mb-5">{{ $professor->username }}</h1>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 mx-auto">
              @if($professor->name!=null) <p class="font-weight-bold"><strong>{{ trans('labels.name') }}:</strong> {{ $professor->name }}</p> @endif
              @if($professor->suname!=null)<p class="font-weight-bold"><strong>{{ trans('labels.surname') }}:</strong> {{ $professor->surname }}</p> @endif
              @if($professor->career!=null)<p class="font-weight-bold"><strong>{{ trans('labels.career') }}:</strong> {{ $professor->career }}</p> @endif
              <p class="font-weight-bold"><strong>Username:</strong> {{ $professor->username }}</p>
              <p class="font-weight-bold"><strong>Email:</strong> {{ $professor->email }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Courses list for this professor -->
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <h2 class="mt-5 mb-5">{{ trans('labels.coursesList') }}</h2>
    <h5 class="text-muted text-center mb-4">{{ trans('labels.listCoursesProfessor') }} <strong>{{$professor->username}}</strong></h5>
    <br>
      <ul class="list-group list-group-flush">
        @foreach($professor->courses as $course)
          <li class="list-group-item text-center rounded">
            <a href="{{ route('student.coursedetails', $course->id) }}">{{ $course->title }}</a>
          </li>
        @endforeach
      </ul>
      <a href="javascript:history.back()" class="btn btn-success mt-5">{{ trans('labels.back') }}</a>
  </div>
    
  </div>
</div>




@endsection