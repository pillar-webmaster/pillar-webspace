<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;
use App\Designation;
use App\Department;
use App\Http\Requests\OwnerRequest;

class OwnerController extends Controller
{
    //
    public function list(){

        $owners = Owner::active()
            ->orderBy('created_at','ASC')
            ->paginate(20);
        return view('owner.list', compact('owners'));
    }

    public function add(){

        $departments = Department::active()->get();
        $designations = Designation::active()->get();
        return view('owner.add', compact('departments', 'designations'));
    }

    public function create(OwnerRequest $request){

        $owner = Owner::create([
            'name' => $request->input('name'),
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'designation_id' => $request->input('designation_id'),
            'department_id' => $request->input('department_id'),
            'status' => 1,
        ]);

        if ( $owner->id )
            return redirect()->route('owner.list')->with("success", "Owner '" . $owner->name . "' successfully added");
        else
            return redirect()->route('owner.list')->with("error", "There was a problem processing your request");
    }

    public function edit( $id ){

    }
}
