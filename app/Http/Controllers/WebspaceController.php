<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webspace as Webspace;
use App\WebspaceMode as Mode;
use App\Platform as Platform;
use App\WebspaceSupportLevel as SupportLevel;
use App\Owner;
use App\Http\Requests\WebspaceRequest;

class WebspaceController extends Controller
{
    //
    public function list(){
        $webspaces = Webspace::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);

        //dd(Webspace::find([11])->owners());
        return view('webspace.list', compact('webspaces'));
    }

    public function add(Mode $mode, SupportLevel $level){
        $platforms = Platform::active()->get();
        $owners = Owner::active()->get();
        $modes = $mode->all('mode');
        $services = $level->all('support_level');

        return view('webspace.add', compact('platforms', 'modes', 'services', 'owners'));
    }

    public function create(WebspaceRequest $request){

        $webspace = Webspace::create([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'mode' => $request->input('mode'),
            'service' => $request->input('service'),
            'platform_id' => $request->input('platform_id'),
            'description' => $request->input('description'),
            'status' => 1,
        ]);

        $owners = Owner::find($request->owner);
        $owner_webspace = $webspace->owners()->attach($owners);

        if ( $webspace->id )
            return redirect()->route('webspace.list')->with("success", "Webspace '" . $webspace->name . "' successfully added");
        else
            return redirect()->route('webspace.list')->with("error", "There was a problem processing your request");
    }

    public function edit( $id ){

    }
}
