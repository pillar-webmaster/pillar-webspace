<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Webspace as Webspace;
use App\WebspaceMode as Mode;
use App\Platform as Platform;
use App\WebspaceSupportLevel as SupportLevel;
use App\Owner;
use App\ModelHasHistorie;
use App\Http\Requests\WebspaceRequest;
use App\Imports\WebspaceImport;
use Maatwebsite\Excel\Facades\Excel;

class WebspaceController extends Controller
{
    //
    public function list(){
        $webspaces = Webspace::active()
            ->orderBy('created_at','DESC')
            ->paginate(20);
        $i = 0;

        return view('webspace.list', compact('webspaces','i'));
    }

    public function add(Mode $mode, SupportLevel $level){
        $platforms = Platform::active()->get();
        $owners = Owner::active()->get();
        $modes = $mode->all('mode');
        $services = $level->all('support_level');

        return view('webspace.add', compact('platforms', 'modes', 'services', 'owners'));
    }

    public function create(WebspaceRequest $request){

        $webspace = Webspace::create([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'mode' => $request->input('mode'),
            'service' => $request->input('service'),
            'platform_id' => $request->input('platform_id'),
            'description' => $request->input('description'),
            'status' => 1,
        ]);

        $owners = Owner::find($request->input('owner'));
        $owner_webspace = $webspace->owners()->attach($owners);

        $history = $webspace->histories()->create(['description' => "Profile created"]);

        if ( $webspace->id )
            return redirect()->route('webspace.list')->with("success", "Webspace '" . $webspace->name . "' successfully added");
        else
            return redirect()->route('webspace.list')->with("error", "There was a problem processing your request");
    }

    public function edit( $id, Mode $mode, SupportLevel $level ){
        $webspace = Webspace::findOrFail($id);
        $platforms = Platform::active()->get();
        $owners = Owner::active()->get();
        $modes = $mode->all('mode');
        $services = $level->all('support_level');
        $histories = ModelHasHistorie::query()
            ->where('model_id', $webspace->id)
            ->get();

        return view('webspace.edit', compact('platforms', 'modes', 'services', 'owners', 'webspace', 'histories'));
    }

    public function update(WebspaceRequest $request, $id){
        $webspace = Webspace::findOrFail($id);
        $webspace->name = $request->input('name');
        $webspace->url = $request->input('url');
        $webspace->mode = $request->input('mode');
        $webspace->service = $request->input('service');
        $webspace->platform_id = $request->input('platform_id');
        $webspace->description = $request->input('description');
        $webspace->update();

        // detach old values first
        $owners = Owner::find($webspace->owners()->get()->pluck('id')->toArray());
        $owner_webspace = $webspace->owners()->detach($owners);
        // re-attach new changes
        $owners = Owner::find($request->input('owner'));
        $owner_webspace = $webspace->owners()->attach($owners);

        if ( $webspace->id )
            return redirect()->route('webspace.list')->with("success", "Webspace '" . $webspace->name . "' successfully updated");
        else
            return redirect()->route('webspace.list')->with("error", "There was a problem processing your request");
    }

    public function remove($id){
        $webspace = Webspace::findOrFail($id);
        // set status to deleted (soft delete)
        $webspace->status = 0;
        $webspace->update();
        // detach old values
        $owners = Owner::find($webspace->owners()->get()->pluck('id')->toArray());
        $owner_webspace = $webspace->owners()->detach($owners);

        return redirect()->route('webspace.list')->with("success", "Webspace '" . $webspace->name . "' successfully deleted");
    }

    public function details( Request $request, Mode $mode, SupportLevel $support ){
        $webspace = Webspace::findOrFail($request->input('id'));
        $mode = $mode->get_webspace_mode($webspace->mode);
        $support_level = $support->get_webspace_support_level($webspace->service);
        $view = view('webspace.details', compact('webspace','mode','support_level'))->render();
        return response()->json(array('html' => $view),200);
    }

    public function export(){
        return view('webspace.export');
    }

    public function export_to_csv(Mode $mode, SupportLevel $support){
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=webspace-".time().".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $webspaces = Webspace::active()
            ->orderBy('created_at','DESC')
            ->get();

        dd($webspaces);

        $columns = [
            'Name', 'Owner/s', 'URL', 'Platform', 'Status', 'Service', 'Created at'
        ];

        $callback = function() use ($webspaces, $columns, $mode, $support){
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($webspaces as $webspace) {
                fputcsv($file,
                [
                    $webspace->name,
                    $webspace->owners->pluck('name')->implode(', '),
                    $webspace->url,
                    $webspace->platform->name . '(' . $webspace->platform->version . ')',
                    $mode->get_webspace_mode($webspace->mode),
                    $support->get_webspace_support_level($webspace->service),
                    $webspace->created_at
                ]);
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    public function add_history ( Request $request ){

        $this->validate($request,
                ['id' => ['required', 'integer'],
                'description' => ['required','string', 'max:1000'],
            ]);

        $webspace = Webspace::findOrFail($request->input('id'));
        $history = $webspace->histories()->create([
            'description' => $request->input('description')
        ]);

        return response()->json(['success' => 'History successfully added, fill-up the form to add new entry or click Close to exit this dialog']);
    }

    public function import(){
        return view('webspace.import');
    }

    public function import_to_csv(Request $request){
        Excel::import(new WebspaceImport, request()->file('csv_file'));
        return redirect('/')->with('success', 'All good!');
    }
}
