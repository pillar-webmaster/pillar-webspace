@extends('layouts.app', ['activePage' => 'designation_list', 'titlePage' => __('Designation')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">List</h4>
            <p class="card-category">Designation that is linked to the owner</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>ID</th>
                  <th>Name</th>
                  <th></th>
                </thead>
                <tbody>
                  @if ($designations->count())
                    @foreach($designations as $designation)
                      <tr>
                        <td>{{$designation->id}}</td>
                        <td>{{$designation->name}}</td>
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