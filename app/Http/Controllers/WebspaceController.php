<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webspace;

class WebspaceController extends Controller
{
    //
    public function list(){
        $webspaces = Webspace::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);
        return view('webspace.list', compact('webspaces'));
    }

    public function add(){
        return view('webspace.add');
    }

    public function create(Request $request){
        dd($request);
        return false;
    }
}
