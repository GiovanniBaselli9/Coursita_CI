@extends('layouts.master')

@section('titolo')
{{ trans('labels.courseDetails') }} - {{ trans('labels.siteTitle') }}
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
<li><a href="{{ route('student.index') }}">{{ trans('labels.personalArea')}}</a></li>
<li><a class="active">{{ trans('labels.courseDetails') }}</a></li>
@endsection

@section('corpo')
<!-- Jumbotron -->
<div class="jumbotron">
  <h1 class="display-4">{{ trans('labels.courseDetails') }} - <i>{{ $course->title }}</i></h1>
  <p class="lead">
  </p>
</div>
<!-- Course details -->
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-6">
      <div class="card card-student h-100">
        <div class="card-body">
          <img class="course-logo" src="{{ url('/') }}/img/macroareas/{{ $course-> macroarea }}.png" alt="course">
          <h5 class="text-center"><i>{{ trans('labels.courseName') }}</i></h5>
          <h2 class="text-center mb-5 card-title">{{ $course->title }}</h2>
          <br>
          <div class="bg-light p-3 mb-3">
            <p class="h4 mb-0"><strong>Macroarea:</strong>
            @switch($course->macroarea)
            @case('Arts')
              {{ trans('labels.arts') }}
              @break
            @case('Humanities')
              {{ trans('labels.humanities') }}
              @break
            @case('Science')
              {{ trans('labels.science') }}
              @break
            @case('Social Sciences')
              {{ trans('labels.socialSciences') }}
              @break
            @case('Technology')
              {{ trans('labels.technology') }}
              @break
            @case('Business')
              {{ trans('labels.business') }}
              @break
            @case('Education')
              {{ trans('labels.education') }}
              @break
            @case('Other')
              {{ trans('labels.other') }}
              @break
            @endswitch
            </p>
          </div>
          <div class="bg-light p-3 mb-3">
            <p class="h4 mb-0"><strong>Info:</strong> {{ $course->info }}</p>
          </div>
          <div class="bg-light p-3 mb-3">
            <p class="h4 mb-0"><strong>Professor:</strong> {{ $professor->username }} <a href="{{ route('student.professordetails', $professor->id) }}" class="btn btn-primary btn-sm">{{ trans('labels.details') }}</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3 d-flex justify-content-end align-items-center">
      @if($student->courses->contains($course))
        <!-- Button trigger modal for unsubscribe -->
        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $course->id }}">{{ trans('labels.unsubscribe') }}</button><br>
      @else
        <!-- Subscribe button -->
        <form action="{{ route('course.subscribe', $course->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">{{ trans('labels.subscribe') }}</button>
        </form>
      @endif
      <br>
      <!-- Back button -->
      <a href="javascript:history.back()" class="btn btn-success">{{ trans('labels.back') }}</a>
    </div>

  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">{{ trans('labels.unsubscribeConfirmTitle')}}</h5>
      </div>
      <div class="modal-body">
        {{ trans('labels.courseName')}}: <i>{{ $course->title }}</i>
        <br>
        <strong>{{ trans('labels.unsubscribeConfirm') }}</strong>
      </div>
      <div class="modal-footer d-flex justify-content-between align-items-center flex-wrap">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('labels.cancel') }}</button>
        <form action="{{ route('course.unsubscribe', $course->id) }}" id="deleteForm" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">{{ trans('labels.unsubscribe') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!--
<div class="container my-5">
    <h2 class="text-center mb-5">{{ $course->title }}</h2>
    <p><strong>Info:</strong> {{ $course->info }}</p>
    <p><strong>Professor:</strong> {{ $professor->username }} <a href="{{ route('student.professordetails', $professor->id) }}" class="btn btn-primary btn-sm">Details</a></p>
    <div class="d-flex justify-content-center mt-5">
      @if($student->courses->contains($course))
        <form action="{{ route('course.unsubscribe', $course->id) }}" method="POST" class="mr-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Unsubscribe</button>
        </form>
      @else
        <form action="{{ route('course.subscribe', $course->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
      @endif
      <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
    </div>
</div>
  -->



@endsection