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
            ->paginate(20);
        $i = 0;

        return view('designation.list', compact('designations', 'i'));
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
            return redirect()->route('designation.list')->with("success", "'" .  $designation->name . "' successfully added");
        else
            return redirect()->route('designation.list')->with("error", "There was a problem processing your request");

    }

    public function edit( $id ){
        $designation = Designation::findOrFail($id);
        return view('designation.edit', compact('designation'));
    }

    public function update(DesignationRequest $request, $id){
        $designation = Designation::findOrFail($id);
        $designation->name = $request->input('name');
        $designation->update();

        if ( $designation->id )
            return redirect()->route('designation.list')->with("success", "'" .  $designation->name . "' successfully updated");
        else
            return redirect()->route('designation.list')->with("error", "There was a problem processing your request");
    }

    public function remove($id){
        $designation = Designation::findOrFail($id);
        // check if designation is used by an owner, if yes, do not proceed, else, remove
        if ( !$designation->owners()->get()->count() ){
            $designation->status = 0;
            $designation->update();
            return redirect()->route('designation.list')->with("success", "'" . $designation->name . "' successfully deleted");
        }
        else{
            return redirect()->route('designation.list')->with("error", "'" .  $designation->name ."' is still assigned to an owner, unlink them first and delete again");
        }
    }
}
