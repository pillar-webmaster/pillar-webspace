<form method="POST" action="{{ route('webspace.add-history', ['id' => $id]) }}">
  @csrf
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="description" class="text-primary">{{__('Description')}}</label>
        <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp"></textarea>
        @if ($errors->has('description'))
          <span id="description-error" class="error text-danger" for="description">{{ $errors->first('description') }}</span>
        @endif
        <small id="descriptionHelp" class="form-text text-muted">{{__('Input history log')}}</small>
      </div>
      <div class="form-group">
        <input type="hidden" id="id" name="id" value="{{$id}}">
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
          <small id="descriptionHelp" class="form-text text-muted">{{__('Submitting this form will refresh the page')}}</small>
        </div>
      </div>
    </div>
  </div>
</form>