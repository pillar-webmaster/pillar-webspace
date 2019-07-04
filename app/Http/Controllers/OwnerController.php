<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;

class OwnerController extends Controller
{
    //
    public function list(){
        $owners = Owner::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);
        return view('owner.list', compact('owners'));
    }
}
