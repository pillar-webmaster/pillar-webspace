@extends('layouts.app', ['activePage' => 'server_list', 'titlePage' => __('Server')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">List</h4>
            <p class="card-category">Servers used to host webspaces</p>
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
                <div class="row">
                  <div class="col-12 text-right">
                    <!--<a href="{{ route('department.add') }}" class="btn btn-sm btn-primary">
                      <i class="material-icons">control_point</i>&nbsp;{{ __('Add server') }}
                    </a>-->
                  </div>
                </div>
                <div class="table-responsive">
                  Coming soon
                  <!--
                  <table class="table">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Name</th>
                      <th></th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <nav aria-label="Server pages">
                  <div class="pull-right">
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection