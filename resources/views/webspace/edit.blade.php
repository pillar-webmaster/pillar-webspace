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
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="{{__('Enter name')}}" value="{{ $webspace->name }}" required>
                    @if ($errors->has('name'))
                      <span id="designation_id-error" class="error text-danger" for="designation_id">{{ $errors->first('name') }}</span>
                    @endif
                    <small id="nameHelp" class="form-text text-muted">{{__('Input complete name of the owner')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="mode" class="text-primary">{{__('Status')}}</label>
                    <select class="form-control" data-style="btn btn-link" id="mode" name="mode" aria-describedby="modeHelp" required>
                      <option value="">Select</option>
                      @if (count($modes))
                        @foreach ($modes as $key => $value )
                          <option value="{{ $key }}" {{ (collect($webspace->description_status->mode)->contains($key)) ? "selected":"" }}>{{$value}}</option>
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
                    <label for="service" class="text-primary">{{__('Support Level')}}</label>
                    <select class="form-control" data-style="btn btn-link" id="service" name="service" aria-describedby="serviceHelp" required>
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="owner" class="text-primary">{{__('Owner')}}</label>
                    <select multiple="multiple" class="form-control selectpicker hw-100" data-style="select-with-transition" data-live-search="true" id="owner" name="owner[]" data-size="7" required>
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
                    <textarea class="form-control format" id="description" name="description" rows="8" aria-describedby="descriptionHelp">{{clean($webspace->description_status->description)}}</textarea>
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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Websites')}}</h4>
            <p class="card-category">{{__('List of website/s hosted under this webspace')}}</p>
          </div>
          <div class="card-body">
            <table class="table website column-2">
              <thead class=" text-primary">
                <th>ID</th>
                <th>URL</th>
                <th>Platform</th>
              </thead>
              <tbody>
                @if ($webspace->websites->count())
                    @foreach($webspace->websites as $website)
                      <tr>
                        <td>{{$website->id}}</td>
                        <td>
                          {{$website->url}}
                        </td>
                        <td>
                          {{$website->platform->name}}&nbsp;{{$website->platform->version}}
                          <input type="hidden" value="{{$website->platform->id}}" name="platform_id" />
                        </td>
                      </tr>
                    @endforeach
                  @endif
              </tbody>
              <tfoot>
                <th></th>
                <th></th>
                <th></th>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        @include('webspace.history')
      </div>
      <div class="col-md-4">
        @include('media.upload')
      </div>
    </div>
  </div>
  @include('webspace.modal')
</div>
@endsection
@push('js')
  <script type="text/javascript">
    $.extend( true, $.fn.dataTable.defaults, {
      'ordering': false,
      'lengthChange': false,
    } );

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
          data: $('#add-history-form').serialize(),
          beforeSend:function(){
            $('#add-history-form .btn.confirm').html("Submitting");
          },
          success:function(data){
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success span').append(data.success);
            $('#add-history-form')[0].reset();
          },
          error: function (request, status, error) {
            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger').append('<p>'+value+'</p>');
            });
          },
          complete:function(){
            $('#add-history-form .btn.confirm').html("Submit");
          }
        });
      });

      $('#upload-media-form').submit(function(event){
        event.preventDefault();
        $('.alert-success span').html('');
        $('.alert-danger').html('');
        $.ajax({
          type:'POST',
          url:'{{route("webspace.upload-media")}}',
          /*data:{
            id:$('#wrms-modal-for-webspace input[name=id').val(),
            description:$('#wrms-modal-for-webspace textarea[name=description]').val()
          },*/
          data: new FormData($('#upload-media-form')[0]),
          cache: false,
          contentType: false,
          processData: false,
          beforeSend:function(){
            $('#upload-media-form .btn.confirm').html("Uploading");
          },
          success:function(data){
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success span').append(data.success);
            $('#upload-media-form')[0].reset();
          },
          error: function (request, status, error) {
            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger').append('<p>'+value+'</p>');
            });
          },
          complete:function(){
            $('#upload-media-form .btn.confirm').html("Submit");
          }
        });
      });

      $('#wrms-modal-for-webspace .modal-footer .btn.btn-secondary, #wrms-modal-for-webspace .close').click(function(){
        location.reload(true);
      });

      $('.add-history').click(function(event){
        event.preventDefault();
        $('.form-media').hide();
        $('.form-history').show();
      });

      $('.upload-media').click(function(event){
        event.preventDefault();
        $('.form.history').hide();
        $('.form-media').show();
      });

      $('.history').DataTable();

      /* datatable editor */
      var websiteTable = $('.website').DataTable({
        columnDefs: [
          {
            targets: 0,
            type: "text",
            title : "ID",
            name: "website_id",
            readonly: true,
            id : "website_id",
            data: "website_id",
            seachable: false,
          },
          {
            targets: 1,
            type: "text",
            title : "URL",
            name: "url",
            required: true,
            id : "url",
            data: "url",
          },
          {
            targets: 2,
            type: "select",
            options: {!!$platforms!!},
            title : "Platform",
            required : true,
            id : "platform",
            data : "platform",
            /*
            render: function(){
              $select = "<select>";
              $.each({!!$platforms!!}, function (index, value){
                $select += "<option>"+value+"</option>";
              });
              $select += "</select>"
              return $select;
            },*/
          }
        ],
        dom: 'Bfrtip',
        select: 'single',
        responsive: true,
        altEditor: true,
        buttons: [
              { text: 'Add',name: 'add'},
              { extend: 'selected', text: 'Edit', name: 'edit'},
              { extend: 'selected', text: 'Delete', name: 'delete'}
            ],
        onAddRow: function(datatable, rowdata, success, error) {
          $.ajax({
              url: "{{route('website.create', ['id' => $webspace->id])}}",
              type: 'POST',
              data: rowdata,
              success: success,
              error: error
          });
        },
        onDeleteRow: function(datatable, rowdata, success, error) {
          $.ajax({
              url: "{{route('website.remove')}}",
              type: 'POST',
              data: rowdata,
              success: success,
              error: error
          });
        },
        onEditRow: function(datatable, rowdata, success, error) {
          $.ajax({
              url: "{{route('website.update')}}",
              type: 'POST',
              data: rowdata,
              success: success,
              error: error
          });
        },
      });

      websiteTable.on( 'buttons-action', function ( e, buttonApi, dataTable, node, config ) {
        if ( buttonApi.text() == "Edit"){
          var $the_form_id = $("[id^=altEditor-modal]").find("form").attr("id");
          var $the_select_id = $("#" + $the_form_id).find("select").attr("id");
          $selected = $("#DataTables_Table_1 tr.selected td").eq(2).find("input[type=hidden]").val();
          $("#" + $the_select_id + " option").each(function(){
            if ($(this).val() == $selected ){
              $(this).prop("selected",true);
            }
          });
        }
      });
  });

  </script>
@endpush