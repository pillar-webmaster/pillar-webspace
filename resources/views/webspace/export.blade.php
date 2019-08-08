@extends('layouts.app', ['activePage' => 'webspace-export', 'titlePage' => __('Export Webspaces')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Export</h4>
            <p class="card-category">Here you can export webspace records to CSV file</p>
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
                  <a rel="tooltip" title="Export to CSV file" class="export-csv" href="#">
                    <div class="card text-center" style="width: 18rem;">
                      <i class="material-icons md-100">save_alt</i>
                      <div class="card-body">
                        <h4 class="card-title">Export webspaces to CSV</h4>
                        <p class="card-text">Clicking will allow you to download a CSV file with data from webspaces</p>
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
                  <a rel="tooltip" title="Export to Excel file" class="export-xlsx" href="#">
                    <div class="card text-center" style="width: 18rem;">
                      <span class="text-center"><i class="material-icons md-100">save_alt</i></span>
                      <div class="card-body">
                        <h4 class="card-title">Export webspaces to XLSX</h4>
                        <p class="card-text">Clicking will allow you to download an MS Excel file with data from webspaces</p>
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
      $('a.export-csv').click(function(event){
        event.preventDefault();
        $('#export-to-csv' ).submit();
      });
      $('a.export-xlsx').click(function(event){
        event.preventDefault();
        alert('Sorry, not yet implemented.');
      });
    });
  </script>
@endpush