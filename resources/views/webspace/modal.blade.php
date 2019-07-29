<div class="modal hide fade" id="wrms-modal-for-webspace" tabindex="-1" role="dialog" aria-labelledby="wrms-modal-for-webspace" aria-hidden="true" data-focus-on="input:first">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="wrms-modal-label"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-success" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="material-icons">close</i>
        </button>
        <span><b> Success - </b> </span>
      </div>
      <div class="alert alert-danger" style="display:none">
        @foreach ($errors->all() as $error)
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
          </button>
          <span><b> Error - </b> {{ $error }}</span>
        @endforeach
      </div>
      <div class="modal-body">
        <div class="form-history" style="display:none;">
          <form method="POST" action="{{ route('webspace.add-history', ['id' => $webspace->id]) }}" id="add-history-form">
            @csrf
            <div class="form-group">
              <label for="description" class="text-primary">{{__('Description')}}</label>
              <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp" required autofocus ></textarea>
              @if ($errors->has('description'))
                <span id="description-error" class="error text-danger" for="description">{{ $errors->first('description') }}</span>
              @endif
              <small id="descriptionHelp" class="form-text text-muted">{{__('Input history log')}}</small>
            </div>
            <div class="form-group">
              <input type="hidden" id="id" name="id" class="id" value="{{$webspace->id}}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary confirm" id="submit-history">{{__('Submit')}}</button>
            </div>
          </form>
        </div>
        <div class="form-media" style="display:none;">
          <form method="POST" action="{{ route('webspace.upload-media', ['id' => $webspace->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="description" class="text-primary">{{__('Description')}}</label>
              <textarea class="form-control" id="description" name="description" rows="8" aria-describedby="descriptionHelp"></textarea>
              @if ($errors->has('description'))
                <span id="description-error" class="error text-danger" for="description">{{ $errors->first('description') }}</span>
              @endif
              <small id="descriptionHelp" class="form-text text-muted">{{__('Input description for the file')}}</small>
            </div>
            <div class="form-group">
              <label for="path" class="text-primary">{{__('Media/File')}}</label>
              <input id="path" type="file" class="form-control" name="path" value="" required autofocus>
              @if ($errors->has('path'))
                <span id="path-error" class="error text-danger" for="path">{{ $errors->first('path') }}</span>
              @endif
              <small id="pathHelp" class="form-text text-muted">{{__('Upload a file')}}</small>
            </div>
            <div class="form-group">
              <input type="hidden" id="webspace_id" name="webspace_id" value="{{$webspace->id}}">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
              <small id="descriptionHelp" class="form-text text-muted">{{__('Submitting this form will refresh the page')}}</small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>