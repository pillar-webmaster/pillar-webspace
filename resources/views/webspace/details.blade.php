<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title font-weight-bold">{{$webspace->name}}</h4>
        <hr />
        <p class="card-text"><strong>Status: </strong>{{ $mode }}</p>
        <p class="card-text"><strong>Support Level: </strong>{{ $support_level }}</p>
        <p class="card-text"><strong>Owner/s: </strong>{{ $webspace->owners->pluck('name')->implode(', ') }}</p>
        <p class="card-text"><strong>Description: </strong>{!! $webspace->description_status->description !!}</p>
      </div>
    </div>
  </div>
</div>