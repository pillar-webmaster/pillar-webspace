<?php

namespace App\Http\Controllers;

use App\Website;
use App\Webspace;
use Auth;
use App\Http\Requests\WebsiteRequest;
use Illuminate\Http\Request;

class WebsiteController extends Controller
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
    public function create(WebsiteRequest $request, $id) {

        $website = Website::create([
            'url' => $request->input('url'),
            'platform_id' => $request->input('platform'),
            'webspace_id' => $id,
            'status' => 1,
        ]);

        // add entry to history
        $webspace = Webspace::findOrFail($id);
        $history = $webspace->histories()->create(['description' => "Website " . $website->url . " added by " . auth()->user()->name, ]);

        if ( $website->id )
            return response()->json([
                'website_id' => $website->id,
                'url' => $website->url,
                'platform' => $website->platform->name . " " . $website->platform->version,
                'platform_id' => $website->platform->id
            ], "200");

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
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(WebsiteRequest $request){

        $website = Website::findOrFail($request->input("website_id"));
        $old_website_url = $website->url;
        $old_website_platform = $website->platform->name;
        $old_website_platform_version = $website->platform->version;
        $website->url = $request->input("url");
        $website->platform_id = $request->input("platform"); 
        $website->update();
        $website = $website->fresh();

        $webspace = Webspace::findOrFail($website->webspace_id);
        $history = $webspace->histories()->create(
            ['description' => "Website URL:{$old_website_url}, platform:{$old_website_platform} {$old_website_platform_version}
            updated to URL:{$website->url}, platform:{$website->platform->name} {$website->platform->version}
            by " . auth()->user()->name, 
        ]);

        return response()->json(['website_id' => $website->id, 'url' => $website->url, 'platform' => $website->platform->name . " " . $website->platform->version], "200");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }

    public function remove(WebsiteRequest $request){
        $website = Website::findOrFail($request->input("website_id"));
        $webspace = Webspace::findOrFail($website->webspace_id);
        $the_url = $website->url;
        $website->status = 0;
        $website->update();

        
        $history = $webspace->histories()->create(
            ['description' => "Website {$the_url} removed by " . auth()->user()->name, ]
        );
    }

    public function get_platform_id(Request $request){

        $request->validate([
            'website_id' => 'required|digits_between:1,10',
        ]);

        $platform_id = Website::find($request->input('website_id'));

        return $platform_id->platform->id;
    }
}
