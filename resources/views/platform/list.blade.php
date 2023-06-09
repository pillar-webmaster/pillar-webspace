@extends('layouts.app', ['activePage' => 'platform_list', 'titlePage' => __('Platform')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">List</h4>
            <p class="card-category">Platform that is used by a webspace</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                @if(session()->get('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span><b> Success - </b> {{ session()->get('success') }}</span>
                </div>
                @endif
                @if(session()->get('error'))
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span><b> Error - </b> {{ session()->get('error') }}</span>
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                @hasanyrole("super-admin|admin")
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('platform.add') }}" class="btn btn-sm btn-warning">
                      <i class="material-icons">control_point</i>&nbsp;{{ __('Add platform') }}
                    </a>
                  </div>
                </div>
                @endhasanyrole
                <div class="row">
                  <div class="col-12">
                    <table class="table platform">
                      <thead class=" text-primary">
                        <th>Name</th>
                        <th>Version</th>
                        <th></th>
                      </thead>
                      <tbody>
                        @if ($platforms->count())
                          @foreach($platforms as $platform)
                            <tr>
                              <td>
                                @hasanyrole("super-admin|admin|editor")
                                  <a rel="tooltip" title="Edit" class="" href="{{route('platform.edit',['id' => $platform->id])}}">
                                @endhasanyrole
                                {{$platform->name}}
                                @hasanyrole("super-admin|admin|editor")
                                  </a>
                                @endhasanyrole
                              </td>
                              <td>{{$platform->version}}</td>
                              <td>
                                <a rel="tooltip" title="Click to view details" class="btn btn-primary btn-link btn-sm view-details" href="" data-toggle="modal" data-target="#wrms-modal" id="{{$platform->id}}">
                                  <i class="material-icons">remove_red_eye</i>
                                </a>
                                @hasanyrole("super-admin|admin|editor")
                                <a rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm" href="{{route('platform.edit',['id' => $platform->id])}}">
                                  <i class="material-icons">edit</i>
                                </a>
                                @endhasanyrole
                                @hasanyrole("super-admin|admin")
                                <form method="POST" action="{{route('platform.remove', ['id' => $platform->id])}}" class="delete-form" id="delete-form-{{$platform->id}}">
                                  @csrf
                                  <a rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm btn delete" data-toggle="modal" data-target="#wrms-modal" id="{{$platform->id}}">
                                    <i class="material-icons">close</i>
                                  </a>
                                </form>
                                @endhasanyrole
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
          </div>
        </div>
      </div>
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
      var id = "";
      $('.btn.delete').click(function(event){
        event.preventDefault();
        id = $(this).attr('id');
        $('.modal-title').html('Delete Platform Notice');
        $('.modal-body').html('Are you sure you want to perform this action?');
      });
      $('button.confirm').click(function(event){
        event.preventDefault();
        $('#delete-form-' + id ).submit();
      });
      $('.view-details').click(function(event){
        event.preventDefault();
        id = $(this).attr('id');
        $('.btn.btn-primary.confirm').hide();
        $('.modal-title').html('Details');
        $('.modal-body').html('No details found');
        $.ajax({
          type:'POST',
          url:'{{route("platform.details")}}',
          data:{id:id},
            success:function(data){
              $('.modal-body').html(data.html);
            }
        });
      });

      $.extend( true, $.fn.dataTable.defaults, {
        'lengthChange': false,
        "pageLength": 20,
      } );
      $('.table').DataTable({
        "columnDefs": [
          { "orderable": false, "targets": [2] },
          { "searchable": false, "targets": [2] }
        ]
      });

    });
  </script>
@endpush