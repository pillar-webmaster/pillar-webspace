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
        $owner = Owner::findOrFail($id);
        $departments = Department::active()->get();
        $designations = Designation::active()->get();
        return view('owner.edit', compact('departments', 'designations', 'owner'));
    }

    public function update(OwnerRequest $request, $id){
        $owner = Owner::findOrFail($id);
        $owner->name = $request->input('name');
        $owner->contact = $request->input('contact');
        $owner->email = $request->input('email');
        $owner->designation_id = $request->input('designation_id');
        $owner->department_id = $request->input('department_id');
        $owner->update();

        if ( $owner->id )
            return redirect()->route('owner.list')->with("success", "Owner '" . $owner->name . "' successfully updated");
        else
            return redirect()->route('owner.list')->with("error", "There was a problem processing your request");
    }

    public function remove($id){
        return __METHOD__;
    }
}
