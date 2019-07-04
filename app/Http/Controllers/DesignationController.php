<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;

class DesignationController extends Controller
{
    //
    public function list(){
        $designations = Designation::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);
        return view('designation.list', compact('designations'));
    }

    public function add(){
        return view('designation.add');
    }

    public function create(Request $request){
        dd($request);
        return false;
    }
}
