@extends('layouts.app', ['activePage' => 'webspace-import', 'titlePage' => __('Import Webspaces')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">{{__('Import')}}</h4>
            <p class="card-category">{{__('Create webspaces in batches using CSV file')}}</p>
          </div>
          <div class="card-body">
            <!--<div class="row">
              <div class="col-md-12 text-right">
                <a href="{{ route('department.list') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
              </div>
            </div>-->
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
            <form method="POST" action="{{ route('webspace.import_from_csv') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="import-csv-path" class="text-primary">{{__('File')}}</label>
                    <input id="import-csv-path" type="file" class="form-control" name="import-csv-path" value="" required autofocus>
                    @if ($errors->has('import-csv-path'))
                      <span id="import-csv-path-error" class="error text-danger" for="import-csv-path">{{ $errors->first('import-csv-path') }}</span>
                    @endif
                    <small id="import-csv-pathHelp" class="form-text text-muted">{{__('Upload a CSV file for import')}}</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title ">{{__('Important Instructions')}}</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <ol>
                <li>You can only import a <strong>CSV</strong> file</li>
                <li>Each item should be separated by pipe symbol "|" (applicable only to department, designation, owner and owner email columns )</li>
                <li>The number of owner must correspond with the number of department, designation, owner and owner email</li>
                <li>The data for department, designation and owner email should correspond in to the position of owner in the column</li>
                <li>Status column only accepts values ['Active','Disabled','Inactive','Deleted']</li>
                <li>Support column only accepts values ['Full','Co-Managed','Technical','Hosting']</li>
              </ol>
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