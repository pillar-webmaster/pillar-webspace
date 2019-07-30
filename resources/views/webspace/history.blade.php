<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title ">{{__('History')}}</h4>
    <p class="card-category">{{__('List all activities happened for this webspace')}}</p>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 text-right">
        <a rel="tooltip" title="Click to add history" class="add-history btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#wrms-modal-for-webspace" data-backdrop="static" data-keyboard="false">{{ __('Add history') }}</a>
      </div>
    </div>
    <div class="card p-3">
      <div class="card-body">
        <table class="table history column-2">
          <thead class=" text-primary">
            <th>Description</th>
            <th>Created at</th>
          </thead>
          <tbody>
            @if (count($histories))
              @foreach ($histories as $history)
                <tr>
                  <td>{{$history->description}}</td>
                  <td>{{$history->created_at}}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
          <tfoot>
            <th></th>
            <th></th>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
