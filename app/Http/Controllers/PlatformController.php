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
        return view('platform.list', compact('platforms'));
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

    public function update(){
        return __METHOD__;
    }
}
