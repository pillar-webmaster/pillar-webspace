<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    //
    public function list(){
        $departments = Department::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);
        return view('department.list', compact('departments'));
    }
}
