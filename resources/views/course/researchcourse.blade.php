@extends('layouts.master')

@section('titolo')
{{ trans('labels.searchCourse') }} - {{ trans('labels.siteTitle') }}
@endsection

@section('stile', 'style.css')

@section('style')
<style>
    .jumbotron {
        background-image: url("{{ url('/') }}/img/search.png");
        background-size: cover;
    }
</style>
@endsection

@section('breadcrumb')
<li><a class="active">{{ trans('labels.searchCourse') }}</a></li>
@endsection

@section('corpo')
<!-- Jumbotron -->
<div class="jumbotron">
    <h1 class="display-4">{{ trans('labels.searchCourse')}}</h1>
</div>

<div class="container">
  <!-- Search -->
  <section class="section-search">
    <form action="{{ $user_type == 'professor' ? route('professor.researchcourse') : route('student.researchcourse') }}" method="GET" class="mb-4">
      <div class="form-group d-flex justify-content-between align-items-center">
        <label for="search_type">{{ trans('labels.searchBy') }}: </label>
        <select name="search_type" id="search_type" class="form-control">
          <option value="title">{{ trans('labels.title') }}</option>
          <option value="macroarea">Macroarea</option>
          <option value="info">Info</option>
        </select>
        <script src="{{ url('/') }}/js/search.js"></script>

        <!-- Macroarea selection -->
        <select name="macroarea" id="macroarea" class="form-control" style="display:none;">
          <option value="Arts">{{ trans('labels.arts') }}</option>
          <option value="Humanities">{{ trans('labels.humanities') }}</option>
          <option value="Science">{{ trans('labels.science') }}</option>
          <option value="Social Sciences">{{ trans('labels.socialSciences') }}</option>
          <option value="Technology">{{ trans('labels.technology') }}</option>
          <option value="Business">{{ trans('labels.business') }}</option>
          <option value="Education">{{ trans('labels.education') }}</option>
          <option value="Other">{{ trans('labels.other') }}</option>
        </select>

        <!-- Search bar -->
        <br><input type="text" name="q" placeholder="{{ trans('labels.searchCourse') }}" class="form-control mb-2"><br>
        <button type="submit" class="btn btn-primary">{{ trans('labels.search') }}</button>
      </div>
    </form>
  </section>

  @if($courses->count() != 0)
  <section class="section-search">
    <!-- Results for the search -->
    <table class="table table-striped table-responsive">
      <thead>
        <tr>
          <th>{{ trans('labels.courseName') }}</th>
          <th>Macroarea</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($courses as $course)
        <tr>
          <td>{{ $course->title }}</td>
          <td>
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
          </td>
          <td>
            <a href="{{ $user_type == 'professor' ? route('professor.coursedetails', $course->id) : route('student.coursedetails', $course->id) }}" class="btn btn-primary">{{ trans('labels.details') }}</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $courses->links('pagination.paginator') }}
  </section>
</div>
@else
<!-- No courses found -->
<section class="section-search">
  <h4 class="text-center"><strong>{{ trans('labels.noCoursesFound') }}</strong></h4>
</section>
@endif

<div class="container">
  <a href="javascript:history.back()" class="btn btn-success">{{ trans('labels.back') }}</a>
</div>

@endsection