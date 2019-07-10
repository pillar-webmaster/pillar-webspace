@extends('layouts.app', ['activePage' => 'designation_list', 'titlePage' => __('Designation')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Edit')}}</h4>
            <p class="card-category">{{__('Update a designation')}}</p>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('designation.update') }}">
              @csrf
              <div class="form-group">
                <label for="name" class="text-primary">{{__('Name')}}</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ $designation->name }}" required autofocus>
                <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of designation (no acronym)')}}</small>
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