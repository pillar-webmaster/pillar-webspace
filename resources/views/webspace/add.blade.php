@extends('layouts.app', ['activePage' => 'owner_add', 'titlePage' => __('Owner')])

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
            <form method="POST" action="{{ route('owner.create') }}">
              @csrf
              <div class="form-group">
                <label for="name" class="text-primary">{{__('Name')}}</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}">
                <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of the owner')}}</small>
              </div>
              <div class="form-group">
                <label for="contact" class="text-primary">{{__('Contact Number.')}}</label>
                <input type="text" class="form-control" id="contact" name="contact" aria-describedby="contactHelp" placeholder="Enter contact number">
                <small id="contactHelp" class="form-text text-muted">{{__('Input contact number (preferably office phone)')}}</small>
              </div>
              <div class="form-group">
                <label for="email" class="text-primary">{{__('Email')}}</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email address">
                <small id="emailHelp" class="form-text text-muted">{{__('Input email address (preferably corporate email address)')}}</small>
              </div>
              <div class="form-group">
                <label for="mode" class="text-primary">{{__('Status')}}</label>
                <select class="form-control" data-style="btn btn-link" id="mode" name="mode" aria-describedby="modeHelp">
                  <option value="">Select</option>
                  @if (count($modes))
                    @foreach ($modes as $key => $value )
                      <option value="{{ $key }}">{{$value}}</option>
                    @endforeach
                  @endif
                </select>
                <small id="modeHelp" class="form-text text-muted">{{__('Select from the list of statuses')}}</small>
              </div>
              <div class="form-group">
                <label for="support" class="text-primary">{{__('Support Level')}}</label>
                <select class="form-control" data-style="btn btn-link" id="support" name="support" aria-describedby="supportHelp">
                  <option value="">Select</option>
                  @if (count($levels))
                    @foreach ($levels as $key => $value )
                      <option value="{{ $key }}">{{$value}}</option>
                    @endforeach
                  @endif
                </select>
                <small id="supportHelp" class="form-text text-muted">{{__('Select from the list of support level')}}</small>
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