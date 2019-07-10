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
            <form method="POST" action="{{ route('platform.update') }}">
              @csrf
              <div class="form-group">
                <label for="name" class="text-primary">{{__('Name')}}</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ $platform->name }}" required autofocus>
                <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of platform (eg. Wordpress, Drupal, HTML, etc)')}}</small>
              </div>
              <div class="form-group">
                <label for="version" class="text-primary">{{__('Version')}}</label>
                <input type="text" class="form-control" id="version" name="version" aria-describedby="versionHelp" placeholder="Enter version" value="{{ $platform->version }}" required autofocus>
                <small id="versionHelp" class="form-text text-muted">{{__('Input complete version (eg. 1.x.x)')}}</small>
              </div>
              <div class="form-group">
                <label for="requirements" class="text-primary">{{__('Requirements')}}</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="8" aria-describedby="requirementsHelp" required autofocus>{{ $platform->requirements }}</textarea>
                <small id="requirementsHelp" class="form-text text-muted">{{__('Input requirements for the platform (eg. Linux, PHP version, MySQL, etc)')}}</small>
              </div>
              <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection