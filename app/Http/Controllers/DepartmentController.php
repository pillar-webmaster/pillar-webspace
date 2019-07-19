<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    //
    public function list(){
        $departments = Department::active()
            ->orderBy('created_at','ASC')
            ->paginate(20);
        $i = 0;

        return view('department.list', compact('departments','i'));
    }

    public function add(){
        return view('department.add');
    }

    public function create(DepartmentRequest $request){

        $department = Department::create([
            'name' => $request->input('name'),
            'status' => 1,
        ]);

        if ( $department->id )
            return redirect()->route('department.list')->with("success", "'" . $department->name . "' successfully added");
        else
            return redirect()->route('department.list')->with("error", "There was a problem processing your request");
    }

    public function edit( $id ){
        $department = Department::findOrFail($id);
        return view('department.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, $id){
        $department = Department::findOrFail($id);
        $department->name = $request->input('name');
        $department->update();

        if ( $department->id )
            return redirect()->route('department.list')->with("success", "'" . $department->name . "' successfully updated");
        else
            return redirect()->route('department.list')->with("error", "There was a problem processing your request");
    }

    public function remove($id){
        $department = Department::findOrFail($id);
        // check if department is used by an owner, if yes, do not proceed, else, remove
        if ( !$department->owners()->get()->count() ){
            $department->status = 0;
            $department->update();
            return redirect()->route('department.list')->with("success", "'" . $department->name . "' successfully deleted");
        }
        else{
            return redirect()->route('department.list')->with("error", "'" . $department->name ."' is still assigned to an owner, unlink them first and delete again");
        }
    }

    public function details( Request $request ){
        $department = Department::findOrFail($request->input('id'));
        $view = view('department.details', compact('department'))->render();
        return response()->json(array('html' => $view),200);
    }
}
