@extends('layouts.app', ['activePage' => 'designation_add', 'titlePage' => __('Designation')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Create')}}</h4>
            <p class="card-category">{{__('Add a new designation')}}</p>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('designation.create') }}">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name" class="text-primary">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ old('name') }}" required autofocus>
                    <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of designation (no acronym)')}}</small>
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