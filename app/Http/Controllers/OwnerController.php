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
            ->orderBy('name','ASC')
            ->get();

        return view('owner.list', compact('owners'));
    }

    public function add(){

        $departments = Department::active()->orderBy('name','ASC')->get();
        $designations = Designation::active()->orderBy('name','ASC')->get();
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
        $departments = Department::active()->orderBy('name','ASC')->get();
        $designations = Designation::active()->orderBy('name','ASC')->get();
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
        $owner = Owner::findOrFail($id);
        // check if owner is linked to a webspace, if yes, do not proceed, else, remove
        if ( !$owner->webspaces()->get()->count() ){
            $owner->status = 0;
            $owner->update();
            return redirect()->route('owner.list')->with("success", "'" . $owner->name . "' successfully deleted");
        }
        else{
            return redirect()->route('owner.list')->with("error", "'" .  $owner->name ."' is still assigned to a webspace, unlink them first and delete again");
        }
    }

    public function details( Request $request ){
        $owner = Owner::findOrFail($request->input('id'));
        $view = view('owner.details', compact('owner'))->render();
        return response()->json(array('html' => $view),200);
    }
}
