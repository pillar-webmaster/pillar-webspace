@extends('layouts.app', ['activePage' => 'platform_list', 'titlePage' => __('Platform')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Update')}}</h4>
            <p class="card-category">{{__('Update a platform')}}</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 text-right">
                <a href="{{ route('platform.list') }}" class="btn btn-sm btn-warning">{{ __('Back to list') }}</a>
              </div>
            </div>
            <form method="POST" action="{{ route('platform.update', ['id' => $platform->id]) }}">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name" class="text-primary">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ $platform->name }}" required autofocus>
                    @if ($errors->has('name'))
                      <span id="name-error" class="error text-danger" for="name">{{ $errors->first('name') }}</span>
                    @endif
                    <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of platform (eg. Wordpress, Drupal, HTML, etc)')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="version" class="text-primary">{{__('Version')}}</label>
                    <input type="text" class="form-control" id="version" name="version" aria-describedby="versionHelp" placeholder="Enter version" value="{{ $platform->version }}" required>
                    @if ($errors->has('version'))
                      <span id="version-error" class="error text-danger" for="version">{{ $errors->first('version') }}</span>
                    @endif
                    <small id="versionHelp" class="form-text text-muted">{{__('Input complete version (eg. 1.x.x)')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="requirements" class="text-primary">{{__('Requirements')}}</label>
                    <textarea class="form-control format" id="requirements" name="requirements" rows="8" aria-describedby="requirementsHelp">{{ clean($platform->requirements) }}</textarea>
                    @if ($errors->has('requirements'))
                      <span id="requirements-error" class="error text-danger" for="requirements">{{ $errors->first('requirements') }}</span>
                    @endif
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