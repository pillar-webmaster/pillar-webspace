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
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('platform.add') }}" class="btn btn-sm btn-primary">{{ __('Add platform') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Version</th>
                      <th></th>
                    </thead>
                    <tbody>
                      @if ($platforms->count())
                        @foreach($platforms as $platform)
                          <tr>
                            <td>{{$platform->id}}</td>
                            <td>{{$platform->name}}</td>
                            <td>{{$platform->version}}</td>
                            <td>
                              <a rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm" href="{{route('platform.edit',['id' => $platform->id])}}">
                                <i class="material-icons">edit</i>
                              </a>
                              <form method="POST" action="{{route('platform.remove', ['id' => $platform->id])}}" class="delete-form" id="delete-form-{{$platform->id}}">
                                @csrf
                                <a rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm btn delete" data-toggle="modal" data-target="#wrms-modal" id="{{$platform->id}}">
                                  <i class="material-icons">close</i>
                                </a>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <nav aria-label="Designation pages">
                  <div class="pull-right">
                  {{ $platforms->links() }}
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
@section('footer_js')
  <script type="text/javascript">
    $(document).ready(function( $ ){
      var id = "";
      $('.btn.delete').click(function(event){
        event.preventDefault();
        id = $(this).attr('id');
        $('.modal-title').html('Delete Platform Notice');
      });
      $('button.confirm').click(function(event){
        event.preventDefault();
        $('#delete-form-' + id ).submit();
      });
    });
  </script>
@endsection