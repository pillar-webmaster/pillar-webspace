<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platform;
use App\Http\Requests\PlatformRequest;

class PlatformController extends Controller
{
    //
    public function list(){
        $platforms = Platform::active()
            ->orderBy('created_at','ASC')
            ->paginate(20);
        $i = 0;

        return view('platform.list', compact('platforms','i'));
    }

    public function add(){
        return view('platform.add');
    }

    public function create(PlatformRequest $request){

        $platform = Platform::create([
            'name' => $request->input('name'),
            'version' => $request->input('version'),
            'requirements' => $request->input('requirements'),
            'status' => 1,
        ]);

        if ( $platform->id )
            return redirect()->route('platform.list')->with("success", "Platform '" . $platform->name . "' successfully added");
        else
            return redirect()->route('platform.list')->with("error", "There was a problem processing your request");
    }

    public function edit( $id ){
        $platform = Platform::findOrFail($id);
        return view('platform.edit', compact('platform'));
    }

    public function update(PlatformRequest $request, $id){
        $platform = Platform::findOrFail($id);
        $platform->name = $request->input('name');
        $platform->version = $request->input('version');
        $platform->requirements= $request->input('requirements');
        $platform->update();

        if ( $platform->id )
            return redirect()->route('platform.list')->with("success", "Platform '" . $platform->name . "' successfully updated");
        else
            return redirect()->route('platform.list')->with("error", "There was a problem processing your request");
    }

    public function remove($id){
        $platform = Platform::findOrFail($id);
        // check if platform is used by a webspace, if yes, do not proceed, else, remove
        if ( !$platform->webspaces()->get()->count() ){
            $platform->status = 0;
            $platform->update();
            return redirect()->route('platform.list')->with("success", "'" . $platform->name . "' successfully deleted");
        }
        else{
            return redirect()->route('platform.list')->with("error", "'" . $platform->name ."' is still assigned to a webspace, unlink them first and delete again");
        }
    }
}
