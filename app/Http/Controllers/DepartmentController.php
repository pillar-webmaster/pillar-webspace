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
        return view('department.list', compact('departments'));
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
            return redirect()->route('department.list')->with("success", "Department '" . $department->name . "' successfully added");
        else
            return redirect()->route('department.list')->with("error", "There was a problem processing your request");
    }

    public function edit( $id ){

    }
}
