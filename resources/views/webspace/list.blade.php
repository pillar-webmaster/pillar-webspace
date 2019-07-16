@extends('layouts.app', ['activePage' => 'webspace_list', 'titlePage' => __('Webspace')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">List</h4>
            <p class="card-category">Webspaces installed in Pillar Server</p>
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
                    <a href="{{ route('webspace.add') }}" class="btn btn-sm btn-primary">{{ __('Add webspace') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>ID</th>
                      <th>Name</th>
                      <th>URL</th>
                      <th>Owner</th>
                      <th></th>
                    </thead>
                    <tbody>
                      @if ($webspaces->count())
                        @foreach($webspaces as $webspace)
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{$webspace->name}}</td>
                            <td>{{$webspace->url}}</td>
                            <td>
                              @foreach ($webspace->owners as $owner)
                                {{$owner->name}}
                              @endforeach
                            </td>
                            <td>
                              <a rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm" href="{{route('webspace.edit',['id' => $webspace->id])}}">
                                <i class="material-icons">edit</i>
                              </a>
                              <form method="POST" action="{{route('webspace.remove', ['id' => $webspace->id])}}" class="delete-form" id="delete-form-{{$webspace->id}}">
                                @csrf
                                <a rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm btn delete" data-toggle="modal" data-target="#wrms-modal" id="{{$webspace->id}}">
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
                  {{ $webspaces->links() }}
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
        $('.modal-title').html('Delete Webspace Notice');
      });
      $('button.confirm').click(function(event){
        event.preventDefault();
        $('#delete-form-' + id ).submit();
      });
    });
  </script>
@endsection