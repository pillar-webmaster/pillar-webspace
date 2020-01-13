@extends('layouts.app', ['activePage' => 'site-settings', 'titlePage' => __('Site Settings')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Site Settings</h4>
            <p class="card-category">Here you define all settings for the system</p>
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
              <div class="col-sm-12"></div>
            </div>

            <!-- form for web access -->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-warning">
                    <h4>Webspaces access methods</h4>
                    <p class="card-category">Below are lists of webspaces access methods</p>
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
                      <div class="col-12 text-right"></div>
                    </div>
                    <div class="card p-3">
                      <div class="card-body">
                        <table class="table access column-2">
                          <thead class=" text-primary">
                            <th>ID</th>
                            <th>Name</th>
                          </thead>
                          <tbody>
                            @if (count($accesses))
                              @foreach ($accesses as $access)
                                <tr>
                                <td>{{$access->id}}</td>
                                  <td>{{$access->name}}</td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                          <tfoot>
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
            <!-- form for web access -->



          </div>
        </div>
      </div>
    </div>
  </div>
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
    /* datatable editor */
    var accessTable = $('.access').DataTable({
      columnDefs: [
        {
          targets: 0,
          type: "text",
          title : "ID",
          name: "access_id",
          readonly: true,
          id : "access_id",
          data: "access_id",
          seachable: false,
        },
        {
          targets: 1,
          type: "text",
          title : "Name",
          name: "name",
          required: true,
          id : "name",
          data: "name",
        },
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
            url: "{{route('access.create')}}",
            type: 'POST',
            data: rowdata,
            success: success,
            error: error
        });
      },
      onDeleteRow: function(datatable, rowdata, success, error) {
        $.ajax({
            url: "{{route('access.remove')}}",
            type: 'POST',
            data: rowdata,
            success: success,
            error: error
        });
      },
      onEditRow: function(datatable, rowdata, success, error) {
        $.ajax({
            url: "{{route('access.update')}}",
            type: 'POST',
            data: rowdata,
            success: success,
            error: error
        });
      },
    });
  });
</script>
@endpush