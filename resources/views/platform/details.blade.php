<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title font-weight-bold">{{$platform->name}}</h4>
        <hr />
        <p class="card-text"><strong>Version: </strong>{{$platform->version}}</p>
        <p class="card-text"><strong>Requirements: </strong>{!! $platform->requirements !!}</p>
      </div>
    </div>
  </div>
</div>