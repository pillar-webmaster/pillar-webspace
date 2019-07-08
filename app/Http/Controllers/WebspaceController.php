<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webspace as Webspace;
use App\WebspaceMode as Mode;
use App\Platform as Platform;
use App\WebspaceSupportLevel as SupportLevel;
use App\Owner;

class WebspaceController extends Controller
{
    //
    public function list(){
        $webspaces = Webspace::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);
        return view('webspace.list', compact('webspaces'));
    }

    public function add(Mode $mode, SupportLevel $level){
        $platforms = Platform::active()->get();
        $owners = Owner::active()->get();
        $modes = $mode->all('mode');
        $levels = $level->all('support_level');
        return view('webspace.add', compact('platforms', 'modes', 'levels', 'owners'));
    }

    public function create(Request $request){
        dd($request);
        return false;
    }
}
