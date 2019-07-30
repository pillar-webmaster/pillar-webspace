<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use Storage;
use Validator;
use Response;
use File;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        //
        $id = $request->input('id');
        $view = view('media.upload', compact('id'))->render();
        return response()->json(array('html' => $view),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request){

        $media = Media::create([
            'description' => $request->input('description'),
            'webspace_id'   => $request->input('webspace_id'),
            'path' => Storage::disk('local')->path('media'),
            'status' => 1,
        ]);

        $file = $request->file('path');
        $rand_filename = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
        $filename = $rand_filename . "-" . $file->getClientOriginalName();
        $the_path = $file->storeAs('media'. '/' . $request->input('webspace_id'), $filename);

        $new_media = Media::findOrFail($media->id);
        $new_media->path = $the_path;
        $new_media->update();

        return response()->json(['success' => 'Media successfully added, upload new file to add new entry, or, click Close button to exit this dialog']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }

    /** Allow files to be downloaded
     *
     */
    public function download( $media_id ){

        $media = Media::findOrFail($media_id);
        // Check if file exists in app/storage/media folder
        if (Storage::disk('local')->exists($media->path)){
            // Send Download
            return Response::download(
                Storage::disk('local')->path($media->path),
                substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10) . "." . File::extension($media->path),
                ['Content-Length: '. filesize(Storage::disk('local')->path($media->path))]
            );
        } else {
            // Error
            exit( 'Requested file does not exist on our server!' );
        }
    }

}
