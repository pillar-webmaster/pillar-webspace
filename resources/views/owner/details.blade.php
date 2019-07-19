<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title font-weight-bold">{{$owner->name}}</h4>
        <hr />
        <p class="card-text"><strong>Contact Number: </strong>{{$owner->contact}}</p>
        <p class="card-text"><strong>Email: </strong>{{$owner->email}}</p>
        <p class="card-text"><strong>Designation: </strong>{{$owner->designation->name}}</p>
        <p class="card-text"><strong>Pillar/Department </strong>{{$owner->department->name}}</p>
        <p class="card-text"><strong>Webspaces: </strong>{{$owner->webspaces->pluck('name')->implode(', ')}}</p>
        <p class="card-text"><strong>Created at: </strong>{{$owner->created_at}}</p>
      </div>
    </div>
  </div>
</div>