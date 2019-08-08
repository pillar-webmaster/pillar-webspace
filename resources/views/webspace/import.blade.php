@extends('layouts.app', ['activePage' => 'webspace-import', 'titlePage' => __('Import Webspaces')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Export</h4>
            <p class="card-category">Here you can import webspace records from a CSV file</p>
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
            <div class="row justify-content-center" style="text-align:center;">
              <div class="col-sm-6">
                <!-- add form here -->
                <form method="POST" action="{{route('webspace.export_to_csv')}}" class="export-to-csv" id="export-to-csv">
                  @csrf
                  <!--<button type="submit" class="btn btn-primary">{{__('Export webspace to CSV file')}}</button>-->
                  <a rel="tooltip" title="Import from CSV file" class="import-csv" href="#">
                    <div class="card text-center" style="width: 18rem;">
                      <i class="material-icons md-100">cloud_upload</i>
                      <div class="card-body">
                        <h4 class="card-title">Import webspace from a CSV file</h4>
                        <p class="card-text">Clicking will allow you to upload a CSV file containing webspace data which will create new entry in the system</p>
                      </div>
                    </div>
                  </a>
                </form>
              </div>
              <div class="col-sm-6">
                <!-- add form here -->
                <form method="POST" action="{{route('webspace.export_to_csv')}}" class="export-to-xlsx" id="export-csv">
                  @csrf
                  <!--<button type="submit" class="btn btn-primary">{{__('Export webspace to CSV file')}}</button>-->
                  <a rel="tooltip" title="Import from Excel file" class="import-xlsx" href="#">
                    <div class="card text-center" style="width: 18rem;">
                      <span class="text-center"><i class="material-icons md-100">cloud_upload</i></span>
                      <div class="card-body">
                        <h4 class="card-title">Import webspace from a XLSX file</h4>
                        <p class="card-text">Clicking will allow you to upload a Excel file containing webspace data which will create new entry in the system</p>
                      </div>
                    </div>
                  </a>
                </form>
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
      var id = "";
      $('a.import-csv').click(function(event){
        event.preventDefault();
        $('#export-to-csv' ).submit();
      });
      $('a.import-xlsx').click(function(event){
        event.preventDefault();
        alert('Sorry, not yet implemented.');
      });
    });
  </script>
@endpush