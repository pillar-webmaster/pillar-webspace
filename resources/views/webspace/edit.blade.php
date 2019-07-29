@extends('layouts.app', ['activePage' => 'webspace_list', 'titlePage' => __('Owner')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Update')}}</h4>
            <p class="card-category">{{__('Update a webspace')}}</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 text-right">
                <a href="{{ route('webspace.list') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
              </div>
            </div>
            <form method="POST" action="{{ route('webspace.update', ['id' => $webspace->id]) }}">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name" class="text-primary">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ $webspace->name }}" required autofocus>
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
                    <input type="text" class="form-control" id="url" name="url" aria-describedby="urlHelp" placeholder="Enter URL of the webspace" value="{{ $webspace->url }}" required autofocus>
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
                          <option value="{{ $key }}" {{ (collect($webspace->mode)->contains($key)) ? "selected":"" }}>{{$value}}</option>
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
                          <option value="{{ $key }}" {{ (collect($webspace->service)->contains($key)) ? "selected":"" }}>{{$value}}</option>
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
                          <option value="{{ $platform->id }}" {{ (collect($webspace->platform_id)->contains($platform->id)) ? "selected":"" }}>{{$platform->name." (".$platform->version.")"}}</option>
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
                          <option value="{{ $owner->id }}" {{ (in_array( $owner->id, $webspace->owners()->get()->pluck('id')->toArray() ) ? "selected" : "" ) }}>{{$owner->name}}</option>
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
                    <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp">{!! $webspace->description !!}</textarea>
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
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('History')}}</h4>
            <p class="card-category">{{__('List all activities happened for this webspace')}}</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <a rel="tooltip" title="Click to add history" class="add-history btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#wrms-modal-for-history" id="{{$webspace->id}}" >{{ __('Add history') }}</a>
              </div>
            </div>
            <div class="card p-3">
              <div class="card-body">
                @if (count($histories))
                  @foreach ($histories as $history)
                    <p class="card-text">{!!$history->description!!}</p>
                    <p class="card-text"><em><small>{{$history->created_at}}</small></em></p>
                    <hr />
                  @endforeach
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <nav aria-label="History pages">
                  <div class="pull-right">
                  {{ $histories->links() }}
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
   
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Media')}}</h4>
            <p class="card-category">{{__('Include all forms related to this webspace, eg. request, dns, service forms')}}</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <a rel="tooltip" title="Click to upload new media" class="upload-media btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#wrms-modal" id="{{$webspace->id}}" >{{ __('Upload') }}</a>
              </div>
            </div>
            <div class="card p-3">
              <div class="card-body">
                @if (count($webspace->medias))
                  @foreach ($webspace->medias as $media)
                    <p class="card-text">
                      <a href="{{route('media.download', ['media_id' => $media['id']])}}">
                      <i class="material-icons">picture_as_pdf</i>
                        @if ( $media['description'] !== '' )
                          {{$media['description']}}
                        @else
                          {{basename($media['path'])}}
                        @endif
                      </a>
                    </p>
                    <p class="card-text"><em><small>{{$media['created_at']}}</small></em></p>
                    <hr />
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="wrms-modal-for-history" tabindex="-1" role="dialog" aria-labelledby="wrms-modal-for-history" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="wrms-modal-label"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="alert alert-success" style="display:none">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
          </button>
          <span><b> Success - </b> </span>
        </div>
        <div class="alert alert-danger" style="display:none">
          @foreach ($errors->all() as $error)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span><b> Error - </b> {{ $error }}</span>
          @endforeach
        </div>
        <form method="POST" action="{{ route('webspace.add-history', ['id' => $webspace->id]) }}" id="add-history-form">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="description" class="text-primary">{{__('Description')}}</label>
              <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp" ></textarea>
              @if ($errors->has('description'))
                <span id="description-error" class="error text-danger" for="description">{{ $errors->first('description') }}</span>
              @endif
              <small id="descriptionHelp" class="form-text text-muted">{{__('Input history log')}}</small>
            </div>
            <div class="form-group">
              <input type="hidden" id="id" name="id" class="id" value="{{$webspace->id}}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary confirm" id="submit-history">{{__('Submit')}}</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script type="text/javascript">
    $(document).ready(function( $ ){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#add-history-form').submit(function(event){
        event.preventDefault();
        $('.alert-success span').html('');
        $('.alert-danger').html('');
        $.ajax({
          type:'POST',
          url:'{{route("webspace.add-history")}}',
          data:{
            id:$('#wrms-modal-for-history input[name=id').val(),
            description:$('#wrms-modal-for-history textarea[name=description]').val()
          },
          success:function(data){
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success span').append(data.success);
            $('#add-history-form')[0].reset();
            console.log(data.history);
          },
          error: function (request, status, error) {
            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger').append('<p>'+value+'</p>');
            });
          },
        });
      });
      $('#wrms-modal-for-history .modal-footer .btn.btn-secondary, #wrms-modal-for-history .close').click(function(){
        location.reload(true);
      });

      $('.upload-media').click(function(event){
        event.preventDefault();
        id = $(this).attr('id');
        $('.modal-footer').hide();
        $('.modal-title').html('Upload media');
        $('.modal-body').html('No details found');
        $.ajax({
          type:'POST',
          url:'/webspace/media',
          data:{id:id},
            success:function(data){
              $('.modal-body').html(data.html);
            }
        });
      });
    });
  </script>
@endpush