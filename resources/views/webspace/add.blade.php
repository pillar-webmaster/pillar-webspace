@extends('layouts.app', ['activePage' => 'webspace_add', 'titlePage' => __('Owner')])

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
            <form method="POST" action="{{ route('webspace.create') }}">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name" class="text-primary">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                      <span id="designation_id-error" class="error text-danger" for="designation_id">{{ $errors->first('name') }}</span>
                    @endif
                    <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of the owner')}}</small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="url" class="text-primary">{{__('URL')}}</label>
                    <input type="text" class="form-control" id="url" name="url" aria-describedby="urlHelp" placeholder="Enter URL of the webspace" value="{{ old('url') }}" required autofocus>
                    @if ($errors->has('url'))
                      <span id="url-error" class="error text-danger" for="url">{{ $errors->first('url') }}</span>
                    @endif
                    <small id="urlHelp" class="form-text text-muted">{{__('URL used for the webspace')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="mode" class="text-primary">{{__('Status')}}</label>
                    <select class="form-control" data-style="btn btn-link" id="mode" name="mode" aria-describedby="modeHelp" required autofocus>
                      <option value="">Select</option>
                      @if (count($modes))
                        @foreach ($modes as $key => $value )
                          <option value="{{ $key }}">{{$value}}</option>
                        @endforeach
                      @endif
                    </select>
                    @if ($errors->has('mode'))
                      <span id="mode-error" class="error text-danger" for="mode">{{ $errors->first('mode') }}</span>
                    @endif
                    <small id="modeHelp" class="form-text text-muted">{{__('Select from the list of statuses')}}</small>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="service" class="text-primary">{{__('Support Level')}}</label>
                    <select class="form-control" data-style="btn btn-link" id="service" name="service" aria-describedby="serviceHelp" required autofocus>
                      <option value="">Select</option>
                      @if (count($services))
                        @foreach ($services as $key => $value )
                          <option value="{{ $key }}">{{$value}}</option>
                        @endforeach
                      @endif
                    </select>
                    @if ($errors->has('service'))
                      <span id="service-error" class="error text-danger" for="service">{{ $errors->first('service') }}</span>
                    @endif
                    <small id="serviceHelp" class="form-text text-muted">{{__('Select from the list of support level')}}</small>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="platform_id" class="text-primary">{{__('Platform')}}</label>
                    <select class="form-control" data-style="btn btn-link" id="platform_id" name="platform_id" aria-describedby="platform_idHelp" required autofocus>
                      <option value="">Select</option>
                      @if (count($platforms))
                        @foreach ($platforms as $platform)
                          <option value="{{ $platform->id }}">{{$platform->name}}</option>
                        @endforeach
                      @endif
                    </select>
                    @if ($errors->has('platform_id'))
                      <span id="platform_id-error" class="error text-danger" for="platform_id">{{ $errors->first('platform_id') }}</span>
                    @endif
                    <small id="platform_idmHelp" class="form-text text-muted">{{__('Select from the list of platforms')}}</small>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="owner" class="text-primary">{{__('Owner')}}</label>
                    <select multiple="multiple" class="form-control selectpicker hw-100" data-style="select-with-transition" data-live-search="true" id="owner" name="owner[]" data-size="7" required autofocus>
                      @if (count($owners))
                        @foreach ($owners as $owner )
                          <option value="{{ $owner->id }}">{{$owner->name}}</option>
                        @endforeach
                      @endif
                    </select>
                    @if ($errors->has('owner'))
                      <span id="owner-error" class="error text-danger" for="owner">{{ $errors->first('owner') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description" class="text-primary">{{__('Description')}}</label>
                    <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp">{{ old('description') }}"</textarea>
                    @if ($errors->has('description'))
                      <span id="description-error" class="error text-danger" for="description">{{ $errors->first('description') }}</span>
                    @endif
                    <small id="descriptionHelp" class="form-text text-muted">{{__('Input the description of the webspace, eg. usage, purpose, etc.')}}</small>
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