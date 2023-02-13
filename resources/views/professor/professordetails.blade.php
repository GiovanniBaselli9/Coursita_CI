@extends('layouts.master')

@section('titolo')
{{ trans('labels.professorDetails') }} - {{ trans('labels.siteTitle') }}
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
<li><a class="active">{{ trans('labels.professorDetails') }}</a></li>
@endsection

@section('corpo')
<!-- Jumbotron -->
<div class="jumbotron text-center">
  <h1 class="display-4">{{ trans('labels.professorDetails') }} - <i>{{ $professor->username }}</h1>
</div>

<!-- Professor details -->
<div class="container my-5">
    <h1 class="text-center">{{ $professor->username }}</h1>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-6">
            @if($professor->name!=null) <p><b>{{ trans('labels.name') }}:</b> {{ $professor->name}}</p> @endif
            @if($professor->surname!=null) <p><b>{{ trans('labels.surname') }}:</b> {{ $professor->surname}}</p> @endif
            @if($professor->career!=null) <p><b>{{ trans('labels.career') }}:</b> {{ $professor->career}}</p> @endif
            <p><b>{{ trans('labels.username') }}:</b> {{ $professor->username}}</p>
            <p><b>Email:</b> {{ $professor->email }}</p>
        </div>
    </div>
    <hr class="my-4">
    <h2 class="text-center">{{ trans('labels.listCoursesProfessor')}}</h2>
    <ul class="list-group">
        @foreach($professor->courses as $course)
            <li class="list-group-item">
                <a href="{{ route('professor.coursedetails', $course->id) }}">{{ $course->title }}</a>
            </li>
        @endforeach
    </ul>
    
    <a href="javascript:history.back()" class="btn btn-success">{{ trans('labels.back') }}</a>
</div>



@endsection