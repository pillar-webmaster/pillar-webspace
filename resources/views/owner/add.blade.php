@extends('layouts.app', ['activePage' => 'owner_add', 'titlePage' => __('New Owner')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Create')}}</h4>
            <p class="card-category">{{__('Add a new owner')}}</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 text-right">
                <a href="{{ route('owner.list') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
              </div>
            </div>
            <form method="POST" action="{{ route('owner.create') }}">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name" class="text-primary">{{__('Name')}}</label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                      <span id="name-error" class="error text-danger" for="name">{{ $errors->first('name') }}</span>
                    @endif
                    <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of the owner')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group{{ $errors->has('contact') ? ' has-danger' : '' }}">
                    <label for="contact" class="text-primary">{{__('Contact Number.')}}</label>
                    <input type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" id="contact" name="contact" aria-describedby="contactHelp" placeholder="Enter contact number" value="{{ old('contact') }}">
                    @if ($errors->has('contact'))
                      <span id="contact-error" class="error text-danger" for="contact">{{ $errors->first('contact') }}</span>
                    @endif
                    <small id="contactHelp" class="form-text text-muted">{{__('Input contact number (preferably office phone)')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email" class="text-primary">{{__('Email')}}</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email address" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                      <span id="email-error" class="error text-danger" for="email">{{ $errors->first('email') }}</span>
                    @endif
                    <small id="emailHelp" class="form-text text-muted">{{__('Input email address (preferably corporate email address)')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('designation_id') ? ' has-danger' : '' }}">
                    <label for="designation_id" class="text-primary">{{__('Designation')}}</label>
                    <select class="form-control" data-style="btn btn-link" id="designation_id" name="designation_id" aria-describedby="designation_idHelp">
                      <option value="">Select</option>
                      @if ($designations->count())
                        @foreach ($designations as $designation)
                          <option value="{{ $designation->id }}" {{ (collect(old("designation_id"))->contains($designation->id)) ? "selected":"" }}>{{$designation->name}}</option>
                        @endforeach
                      @endif
                    </select>
                    @if ($errors->has('designation_id'))
                      <span id="designation_id-error" class="error text-danger" for="designation_id">{{ $errors->first('designation_id') }}</span>
                    @endif
                    <small id="designation_idHelp" class="form-text text-muted">{{__('Select from the list of designations')}}</small>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('department_id') ? ' has-danger' : '' }}">
                    <label for="department_id" class="text-primary">{{__('Pillar / Department')}}</label>
                    <select class="form-control" data-style="btn btn-link" id="department_id" name="department_id" aria-describedby="department_idHelp">
                      <option value="">Select</option>
                      @if ($departments->count())
                        @foreach ($departments as $department)
                          <option value="{{ $department->id }}" {{ (collect(old("department_id"))->contains($department->id)) ? "selected":"" }}>{{$department->name}}</option>
                        @endforeach
                      @endif
                    </select>
                    @if ($errors->has('department_id'))
                      <span id="department_id-error" class="error text-danger" for="department_id">{{ $errors->first('department_id') }}</span>
                    @endif
                    <small id="department_idHelp" class="form-text text-muted">{{__('Select from the list pillars or departments')}}</small>
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