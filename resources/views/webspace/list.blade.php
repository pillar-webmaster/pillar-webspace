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
                        <td>{{$webspace->id}}</td>
                        <td>{{$webspace->name}}</td>
                        <td>{{$webspace->url}}</td>
                        <td>{{$webspace->owner}}</td>
                        <td>
                          <a rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </a>
                          <a rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection