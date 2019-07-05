<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;
use App\Designation;
use App\Department;

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

    public function create(Request $request){
        dd($request);
        return false;
    }
}
