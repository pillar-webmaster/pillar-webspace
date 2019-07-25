<div class="row">
  <div class="col-md-12">
    <div class="alert alert-info alert-with-icon" data-notify="container">
      <i class="material-icons" data-notify="icon">add_alert</i>
      <span data-notify="message">Upload only PDF version of the file.</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
  <!-- better to have the form submitted via AJAX -->
    <form method="POST" action="{{ route('webspace.upload-media', ['id' => $id]) }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="description" class="text-primary">{{__('Description')}}</label>
            <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp"></textarea>
            @if ($errors->has('description'))
              <span id="description-error" class="error text-danger" for="description">{{ $errors->first('description') }}</span>
            @endif
            <small id="descriptionHelp" class="form-text text-muted">{{__('Input description for the file')}}</small>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="path" class="text-primary">{{__('Media/File')}}</label>
            <input id="path" type="file" class="form-control" name="path" value="" autofocus>
            @if ($errors->has('path'))
              <span id="path-error" class="error text-danger" for="path">{{ $errors->first('path') }}</span>
            @endif
            <small id="pathHelp" class="form-text text-muted">{{__('Upload a file')}}</small>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="webspace_id" name="webspace_id" value="{{$id}}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
              <small id="descriptionHelp" class="form-text text-muted">{{__('Submitting this form will refresh the page')}}</small>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>