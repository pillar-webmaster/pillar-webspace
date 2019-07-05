<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;
use App\Http\Requests\DesignationRequest;

class DesignationController extends Controller
{
    //
    public function list(){
        $designations = Designation::active()
            ->orderBy('created_at','ASC')
            ->paginate(10);
        return view('designation.list', compact('designations'));
    }

    public function add(){
        return view('designation.add');
    }

    public function create(DesignationRequest $request){

        $designation = Designation::create([
            'name' => $request->input('name'),
            'status' => 1,
        ]);

        if ( $designation->id )
            return redirect()->route('designation.list')->with("success", "Designation '" . $designation->name . "' successfully added");
        else
            return redirect()->route('designation.list')->with("error", "There was a problem processing your request");

    }
}
