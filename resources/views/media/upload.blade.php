<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title ">{{__('Media')}}</h4>
    <p class="card-category">{{__('Include all forms related to this webspace, eg. request, dns, service forms')}}</p>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 text-right">
        <a rel="tooltip" title="Click to upload new media" class="upload-media btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#wrms-modal-for-webspace" data-backdrop="static" data-keyboard="false">{{ __('Upload') }}</a>
      </div>
    </div>
    <div class="card p-3">
      <div class="card-body">
        @if (count($webspace->medias))
          @foreach ($webspace->medias as $media)
            <p class="card-text">
              <a href="{{route('media.download', ['media_id' => $media['id']])}}">
              <i class="material-icons">picture_as_pdf</i>
                @if ( $media['description'] !== '' )
                  {{$media['description']}}
                @else
                  {{basename($media['path'])}}
                @endif
              </a>
            </p>
            <p class="card-text"><em><small>{{$media['created_at']}}</small></em></p>
            <hr />
          @endforeach
        @endif
      </div>
    </div>
  </div>
</div>