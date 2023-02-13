@extends('layouts.master')

@section('titolo')
{{ trans('labels.settings') }} - {{ trans('labels.siteTitle') }}
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
<li><a class="active">{{ trans('labels.settings') }}</a></li>
@endsection

@section('corpo')
<div class="jumbotron">
  <h1 class="display-4">{{ trans('labels.settings') }} - <i>{{ $student->username }}</i></h1>
</div>

<!-- Update account section -->
<section>
  <div class="container">
    <h2 class="mb-5">{{ trans('labels.updateAccount') }}</h2>
    <br>
    <form action="{{ route('student.update', $student->id ) }}" method="post">
      @csrf
      @method('PUT')

      <label for="name" class="control-label">{{ trans('labels.name')}}: </label>
      <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $student->name }}"/>
      </div>

      <label for="surname" class="control-label">{{ trans('labels.surname')}}: </label>
      <div class="form-group">
        <input type="text" name="surname" class="form-control" placeholder="Surname" value="{{ $student->surname }}"/>
      </div>

      <label for="username" class="control-label">Username: </label>
      @error('username')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <div class="form-group required">
        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $student->username }}" required/>
      </div>
              
      <label for="email" class="control-label">Email: </label>
      @error('email')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <div class="form-group required">
        <input type="text" name="email" class="form-control" aria-describedby="emailHelpBlock" placeholder="{{ trans('labels.email') }}" value="{{ $student->email }}" required/>
        <small id="emailHelpBlock" class="form-text text-muted">
          {{ trans('labels.emailFormat') }} <strong>localport@domain</strong>.
        </small>
      </div>

      <button type="submit" class="btn btn-primary">{{ trans('labels.update') }}</button>
    </form>
</section>

<!-- Change password section -->
<section id="changepassword">
  <div class="container">
    <h2 class="mb-5">{{ trans('labels.changePassword') }}</h2>
    <br>
    <form action="{{ route('student.passwordupdate', $student->id ) }}" method="post">
      @csrf
      @method('PUT')
      
      <label for="oldpassword" class="control-label">{{ trans('labels.oldPassword') }}: </label>
      @error('oldpassword')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <div class="form-group required">
        <input type="password" name="oldpassword" class="form-control" aria-describedby="passwordHelpBlock" placeholder="{{ trans('labels.oldPassword') }}" value="" required/>
      </div>

      <label for="password" class="control-label">{{ trans('labels.newPassword') }}: </label>
      @error('password')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <div class="form-group required">
        <input type="password" name="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="{{ trans('labels.newPassword') }}" value="" required/>
        <small id="passwordHelpBlock" class="form-text text-muted">
          {{ trans('labels.passwordFormat') }}
        </small>
      </div>
                    
      <label for="password-confirmation" class="control-label">{{ trans('labels.confirmPassword') }}: </label>
      @error('password-confirmation')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <div class="form-group required">
        <input type="password" name="password-confirmation" class="form-control" placeholder="{{ trans('labels.confirmPassword') }}" value="" required/>
      </div>

      <button type="submit" class="btn btn-primary">{{ trans('labels.confirm') }}</button>
    </form>
  </div>
</section>

<!-- Delete account section -->
<section>
  <div class="container">
    <h2 class="mb-5">{{ trans('labels.deleteAccount') }}</h2>
    <br>
    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $student->id }}">{{ trans('labels.delete') }}</button>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">{{ trans('labels.deleteAccountConfirmTitle')}}</h5>
      </div>
      <div class="modal-body">
        {{ trans('labels.studentUsername')}}: <i>{{ $student->username }}</i>
        <br>
        <strong>{{ trans('labels.deleteAccountConfirmMsg') }}</strong>
      </div>
      <div class="modal-footer d-flex justify-content-between align-items-center flex-wrap">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('labels.cancel') }}</button>
        <form action="{{ route('student.destroystudent', $student->id) }}" id="deleteForm" method="get">
            @csrf
            <button type="submit" class="btn btn-danger">{{ trans('labels.delete') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>



@endsection