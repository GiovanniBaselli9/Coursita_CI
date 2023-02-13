@extends('layouts.master')

@section('titolo')
{{ trans('labels.createNewCourse') }} - {{ trans('labels.siteTitle') }}
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
<li><a class="active">{{ trans('labels.createNewCourse') }}</a></li>
@endsection

@section('corpo')

<!-- Jumbotron -->
<div class="jumbotron">
  <h1 class="display-4">{{ trans('labels.createNewCourse')}}</h1>
</div>

<!-- Create Course form -->
<section class="section-professor">
    <div class="container my-5">
    <h4 class="my-4">{{ trans('labels.createNewCourseFor') }} <strong><i>{{ $loggedName }}</i></strong></h2>
    <br>
    <form action="{{ route('course.store') }}" method="POST">
        @csrf
        <div class="form-group">
        <label for="title">{{ trans('labels.title') }}</label>
        <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
        <label for="macroarea">Macroarea</label>
        <select name="macroarea" id="macroarea" class="form-control">
          <option value="Arts">{{ trans('labels.arts') }}</option>
          <option value="Humanities">{{ trans('labels.humanities') }}</option>
          <option value="Science">{{ trans('labels.science') }}</option>
          <option value="Social Sciences">{{ trans('labels.socialSciences') }}</option>
          <option value="Technology">{{ trans('labels.technology') }}</option>
          <option value="Business">{{ trans('labels.business') }}</option>
          <option value="Education">{{ trans('labels.education') }}</option>
          <option value="Other">{{ trans('labels.other') }}</option>
        </select>
        </div>
        <div class="form-group">
        <label for="info">Info</label>
        <textarea class="form-control" id="info" name="info"></textarea>
        </div>
        <div>
        <button type="submit" class="btn btn-primary">{{ trans('labels.save') }}</button>
        </div>
    </form>

    <br><a href="{{ route('professor.index') }}" class="btn btn-danger">{{ trans('labels.cancel') }}</a>
    </div>
</section>

@endsection