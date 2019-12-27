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
              <div class="col-sm-4">
                <!-- add form here -->
                <form method="POST" action="{{route('webspace.export_to_csv_webspace')}}" class="export-to-csv-webspace" id="export-to-csv-webspace">
                  @csrf
                  <!--<button type="submit" class="btn btn-primary">{{__('Export webspace to CSV file')}}</button>-->
                  <a rel="tooltip" title="Export to webspaces CSV file" class="export-csv-webspace" href="#">
                    <div class="card text-center" style="width: 18rem;">
                      <i class="material-icons md-100">save_alt</i>
                      <div class="card-body">
                        <h4 class="card-title">Export <strong>WEBSPACES</strong> to CSV</h4>
                        <p class="card-text">Clicking will allow you to download a CSV file with data from webspaces</p>
                      </div>
                    </div>
                  </a>
                </form>
              </div>
              <div class="col-sm-4">
                <!-- add form here -->
                <form method="POST" action="{{route('webspace.export_to_csv_website')}}" class="export-to-csv-website" id="export-to-csv-website">
                  @csrf
                  <!--<button type="submit" class="btn btn-primary">{{__('Export webspace to CSV file')}}</button>-->
                  <a rel="tooltip" title="Export websites to CSV file" class="export-csv-website" href="#">
                    <div class="card text-center" style="width: 18rem;">
                      <span class="text-center"><i class="material-icons md-100">save_alt</i></span>
                      <div class="card-body">
                        <h4 class="card-title">Export <strong>WEBSITES</strong> to CSV</h4>
                        <p class="card-text">Clicking will allow you to download a CSV file with data from websites</p>
                      </div>
                    </div>
                  </a>
                </form>
              </div>
              <div class="col-sm-4">
                <!-- add form here -->
                <form method="POST" action="{{route('webspace.export_to_xlsx')}}" class="export-to-xlsx" id="export-xlsx">
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
      $('a.export-csv-webspace').click(function(event){
        event.preventDefault();
        $('#export-to-csv-webspace' ).submit();
      });
      $('a.export-csv-website').click(function(event){
        event.preventDefault();
        $('#export-to-csv-website' ).submit();
      });
      $('a.export-xlsx').click(function(event){
        event.preventDefault();
        alert('Sorry, not yet implemented.');
      });
    });
  </script>
@endpush