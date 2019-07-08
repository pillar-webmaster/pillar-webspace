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
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name" class="text-primary">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}">
                    @if ($errors->has('name'))
                      <span id="designation_id-error" class="error text-danger" for="designation_id">{{ $errors->first('designation_id') }}</span>
                    @endif
                    <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of the owner')}}</small>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="url" class="text-primary">{{__('URL')}}</label>
                    <input type="text" class="form-control" id="url" name="url" aria-describedby="urlHelp" placeholder="Enter URL of the webspace">
                    @if ($errors->has('url'))
                      <span id="url-error" class="error text-danger" for="url">{{ $errors->first('url') }}</span>
                    @endif
                    <small id="urlHelp" class="form-text text-muted">{{__('URL used for the webspace')}}</small>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-4">
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
                    @if ($errors->has('mode'))
                      <span id="mode-error" class="error text-danger" for="mode">{{ $errors->first('mode') }}</span>
                    @endif
                    <small id="modeHelp" class="form-text text-muted">{{__('Select from the list of statuses')}}</small>
                  </div>
                </div>
              
                <div class="col-md-4">
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
                    @if ($errors->has('support'))
                      <span id="support-error" class="error text-danger" for="support">{{ $errors->first('support') }}</span>
                    @endif
                    <small id="supportHelp" class="form-text text-muted">{{__('Select from the list of support level')}}</small>
                  </div>
                </div>
              
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="owner" class="text-primary">{{__('Owner')}}</label>
                    <select multiple class="form-control selectpicker hw-100" data-style="select-with-transition" data-live-search="true" id="owner" data-size="7" >
                      @if (count($owners))
                        @foreach ($owners as $key => $value )
                          <option value="{{ $key }}">{{$value->name}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>
              <!--<div class="form-group">
                <label for="exampleFormControlSelect2">Example multiple select</label>
                <select multiple class="selectpicker " data-style="select-with-transition" title="" data-size="7">
                  <option disabled>Choose city</option>
                  <option value="2">Foobar</option>
                  <option value="3">Is great</option>
                </select>
              </div>-->
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description" class="text-primary">{{__('Description')}}</label>
                    <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp"></textarea>
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