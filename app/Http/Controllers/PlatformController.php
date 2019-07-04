<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platform;

class PlatformController extends Controller
{
    //
    public function list(){
        $platforms = Platform::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);
        return view('platform.list', compact('platforms'));
    }
}
