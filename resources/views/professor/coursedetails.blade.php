@extends('layouts.master')

@section('titolo')
{{ trans('labels.courseDetails') }} - {{ trans('labels.siteTitle') }}
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
<li><a href="{{ route('professor.index') }}">{{ trans('labels.personalArea')}}</a></li>
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
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card card-professor h-100">
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
            <p class="h4 mb-0">
                <strong>Professor:</strong> {{ $professor->username }} <a href="{{ $professor->id == $course->professor_id ? route('professor.index') : route('professor.professordetails', $professor->id) }}" class="btn btn-primary btn-sm">{{ trans('labels.details') }}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3 d-flex justify-content-end align-items-center">
        @if($professor->username == $loggedName)
        <!-- Button trigger modal for delete -->
        <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $course->id }}">{{ trans('labels.delete') }}</a>
        <!-- Edit button -->
        <a class="btn btn-primary" href="{{ route('course.edit', $course->id) }}">{{ trans('labels.edit') }}</a>
        @endif
        <!-- Back button -->
        <a class="btn btn-success" href="javascript:history.back()">{{ trans('labels.back')}}</a>
    </div>
  </div>

  <!-- Enrolled students -->
  <div class="row" style="margin-top: 50px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h2 class="mt-5"><strong>{{ trans('labels.enrolledStudents')}}</strong></h2>

        <div class="mb-3">{{ trans('labels.numberEnrolledStudents') }}: <strong>{{ $enrolledStudents->count() }}</strong></div>

        @if($enrolledStudents->count() != 0)
        <!-- Table for enrolled students -->
        <div class="section-professor">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Username</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($enrolledStudents as $student)
                    <tr>
                        <td>{{ $student->username }}</td>
                        <td><a href="{{ route('professor.studentdetails', $student->id) }}" class="btn btn-primary">{{ trans('labels.details') }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $enrolledStudents->links('pagination.paginator') }}
        </div>
        @endif
        </div>
    </div>
    </div>
</div>

<!-- Modal for delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">{{ trans('labels.deleteCourseConfirmTitle')}}</h5>
      </div>
      <div class="modal-body">
        {{ trans('labels.courseName')}}: <i>{{ $course->title }}</i>
        <br>
        <strong>{{ trans('labels.deleteCourseConfirmMsg') }}</strong>
      </div>
      <div class="modal-footer d-flex justify-content-between align-items-center flex-wrap">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('labels.cancel') }}</button>
        <br>
        <form action="{{ route('course.destroycourse', $course->id) }}" id="deleteForm" method="get">
            @csrf
            <button type="submit" class="btn btn-danger">{{ trans('labels.delete') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>



@endsection