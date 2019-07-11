@extends('layouts.app', ['activePage' => 'platform_add', 'titlePage' => __('Platform')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Create')}}</h4>
            <p class="card-category">{{__('Add a new platform')}}</p>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('platform.create') }}">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name" class="text-primary">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ old('name') }}" required autofocus>
                    <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of platform (eg. Wordpress, Drupal, HTML, etc)')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="version" class="text-primary">{{__('Version')}}</label>
                    <input type="text" class="form-control" id="version" name="version" aria-describedby="versionHelp" placeholder="Enter version" value="{{ old('version') }}" required autofocus>
                    <small id="versionHelp" class="form-text text-muted">{{__('Input complete version (eg. 1.x.x)')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="requirements" class="text-primary">{{__('Requirements')}}</label>
                    <textarea class="form-control" id="requirements" name="requirements" rows="8" aria-describedby="requirementsHelp" required autofocus>{{ old('requirements') }}</textarea>
                    <small id="requirementsHelp" class="form-text text-muted">{{__('Input requirements for the platform (eg. Linux, PHP version, MySQL, etc)')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection