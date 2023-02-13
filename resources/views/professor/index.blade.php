@extends('layouts.master')

@section('titolo')
{{ trans('labels.personalArea') }} - {{ trans('labels.siteTitle') }}
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
<li><a class="active">{{ trans('labels.personalArea') }}</a></li>
@endsection

<!-- Home page for professor -->
@section('corpo')
<!-- Jumbotron -->
<div class="jumbotron">
  <h1 class="display-4">{{ trans('labels.hello') }} <i>{{ $loggedName }}</i>, {{ trans('labels.welcomeBack') }}</h1>
</div>

<!-- List of courses taken by the professor -->
<div class="container my-5">
    <h2 class="text-center mb-5 ">{{ trans('labels.listCoursesProfessorTitle') }}</h2>
    <h4 class="text-muted text-center mb-4">{{ trans('labels.listCoursesProfessorSubtitle') }}</h4>
    @if($listCourses->count() != 0)
    <div class="text-center">
        <br>
        <a href="{{ route('course.create') }}" class="btn btn-success">{{ trans('labels.createNewCourse') }}</a>
    </div>
    <section class="section-professor">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>{{ trans('labels.courseName') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listCourses as $course)
                            <tr>
                            <td>{{ $course->title }}</td>
                            <td>
                                <a href="{{ route('professor.coursedetails', $course->id) }}"
                                class="btn btn-primary">{{ trans('labels.details') }}</a>
                            </td>
                            <td>
                                <a href="{{ route('course.destroycourse', $course->id) }}"
                                class="btn btn-danger"
                                onclick="return showConfirmMessage('{{ $course->title }}');">{{ trans('labels.delete') }}</a>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
    function showConfirmMessage(text) {
        var header = "{{ trans('labels.nameOfCourse') }}: "+text+"\n{{ trans('labels.deleteCourseConfirmMsg') }}";
        if (confirm(header)) {
            return true;
        } else {
            return false;
        }
    }
    </script>

    @else
    <!-- If the professor has no courses -->
    <section class="section-professor">
        <div class="container">
            <h4 class="text-center"><strong>{{ trans('labels.noCoursesProfessor') }}</strong></h4>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <a href="{{ route('course.create') }}" class="btn btn-success btn-block" style="justify-content: center; align-items: center;">{{ trans('labels.createNewCourse') }}</a>
                </div>
            </div>
        </div>
    </section>
    @endif
    {{ $listCourses->links('pagination.paginator') }}
</div>

@endsection