<?php

namespace App\Http\Controllers;

use App\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $access = Access::firstOrCreate([
            'name' => $request->input('name'),
            'status' => 1,
        ]);

        if ( $access->id )
            return response()->json(['access_id' => $access->id,'name' => $access->name], "200");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function show(Access $access)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function edit(Access $access)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Access $access) {
        //
        $accessObj = $access->findOrFail($request->input('access_id'));
        $accessObj->name = $request->input('name');
        $accessUpdated = $accessObj->update();

        return response()->json(['access_id' => $accessObj->id, 'name' => $accessObj->name], "200");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function destroy(Access $access)
    {
        //
    }

    /**
     * Soft Delete
     */
    public function remove(Request $request, Access $access){
        $accessObj = $access->findOrFail($request->input('access_id'));

        if ( !$accessObj->webspaces()->get()->count()){
            $accessObj->status = 0;
            $accessUpdated = $accessObj->update();
        }
        else{
            return response()->json(['access_id' => $accessObj->id, 'name' => $accessObj->name], "500");
        }

        
    }
}
