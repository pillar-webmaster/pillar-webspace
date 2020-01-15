<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Webspace as Webspace;
use App\WebspaceMode as Mode;
use App\Platform as Platform;
use App\WebspaceSupportLevel as SupportLevel;
use App\Owner;
use App\Auth;
use App\Website;
use App\ModelHasHistorie;
use App\Access;
use App\Http\Requests\WebspaceRequest;
use App\Imports\WebspaceImport;
use Maatwebsite\Excel\Facades\Excel;

class WebspaceController extends Controller
{
    //
    public function list(){
        $webspaces = Webspace::active()
            ->orderBy('name','ASC')->get();
        $i = 1;

        return view('webspace.list', compact('webspaces','i'));
    }

    public function add(Mode $mode, SupportLevel $level){
        //$platforms = Platform::active()->get();
        $owners = Owner::active()->orderBy('name','asc')->get();
        $modes = $mode->all('mode');
        $services = $level->all('support_level');
        $accesses = Access::active()->orderBy('name','asc')->get();

        return view('webspace.add', compact( 'modes', 'services', 'owners', 'accesses' ) );
    }

    public function create(WebspaceRequest $request){

        $webspace = Webspace::create([
            'name' => $request->input('name'),
            'service' => $request->input('service'),
            'status' => 1,
        ]);

        // the description_statusable
        $description_statusable = $webspace->description_status()->create([
            "description" => $request->input('description'),
            "mode" => $request->input('mode')
          ]);

        $accesses = Access::find($request->input('access'));
        $access_webspace = $webspace->accesses()->attach($accesses);

        $owners = Owner::find($request->input('owner'));
        $owner_webspace = $webspace->owners()->attach($owners);

        // the historable
        $history = $webspace->histories()->create(['description' => "Profile created by " . auth()->user()->name, ]);

        if ( $webspace->id )
            // I prefer to edit it directly to input websites
            return redirect()->route('webspace.list')->with("success", "Webspace '" . $webspace->name . "' successfully added");
        else
            return redirect()->route('webspace.list')->with("error", "There was a problem processing your request");
    }

    public function edit( $id, Mode $mode, SupportLevel $level ){
        $webspace = Webspace::findOrFail($id);
        $owners = Owner::active()->orderBy('name','asc')->get();
        $modes = $mode->all('mode');
        $services = $level->all('support_level');
        $accesses = Access::active()->orderBy('name','asc')->get();
        // process platform data to json
        $platforms = Platform::active()->get(['id','name', 'version']);

        foreach ( $platforms as $platform ){
            $platform_array[$platform->id] = $platform->name . " " . $platform->version;
        }
        asort($platform_array);

        $platforms= json_encode($platform_array);

        $histories = ModelHasHistorie::query()
            ->where('model_id', $webspace->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('webspace.edit', compact('platforms', 'modes', 'services', 'owners', 'webspace', 'histories', 'accesses'));
    }

    public function update(WebspaceRequest $request, $id){
        $webspace = Webspace::findOrFail($id);
        $webspace->name = $request->input('name');
        $mode = $request->input('mode');
        $webspace->service = $request->input('service');
        $description = $request->input('description');
        $webspace->update();

        // update access methods
        // detach old values first
        $accesses = Access::findOrFail($webspace->accesses()->get()->pluck('id')->toArray());
        if ( $accesses->count() ){
            $access_webspace = $webspace->accesses()->detach($accesses);
        }
        // re-attach new changes
        $accesses = Access::find($request->input('access'));
        $access_webspace = $webspace->accesses()->attach($accesses);
        // access methods

        // detach old values first
        $owners = Owner::find($webspace->owners()->get()->pluck('id')->toArray());
        $owner_webspace = $webspace->owners()->detach($owners);
        // re-attach new changes
        $owners = Owner::find($request->input('owner'));
        $owner_webspace = $webspace->owners()->attach($owners);

        // add the description_statusable
        $description_statusable = $webspace->description_status()->update([
            "description" => $description,
            "mode" => $mode
          ]);

        if ( $webspace->id )
            return redirect()->back()->with("success", "Webspace '" . $webspace->name . "' successfully updated");
        else
            return redirect()->back()->with("error", "There was a problem processing your request");
    }

    public function remove($id){
        $webspace = Webspace::findOrFail($id);
        // set status to deleted (soft delete)
        $webspace->status = 0;
        $webspace->update();
        /**
         * Update 13 January, 2020
         * For record purposes, do not remove the link between the owner of the webspace
         */
        // detach old values
        //$owners = Owner::find($webspace->owners()->get()->pluck('id')->toArray());
        //$owner_webspace = $webspace->owners()->detach($owners);

        return redirect()->route('webspace.list')->with("success", "Webspace '" . $webspace->name . "' successfully deleted");
    }

    public function details( Request $request, Mode $mode, SupportLevel $support ){
        $webspace = Webspace::findOrFail($request->input('id'));
        $mode = $mode->get_webspace_mode($webspace->description_status->mode);
        $support_level = $support->get_webspace_support_level($webspace->service);
        $view = view('webspace.details', compact('webspace','mode','support_level'))->render();
        return response()->json(array('html' => $view),200);
    }

    public function export(){
        return view('webspace.export');
    }

    public function export_to_csv_webspace(Mode $mode, SupportLevel $support){
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=webspaces-".time().".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $webspaces = Webspace::active()
            ->orderBy('name','ASC')
            ->get();

        $columns = [
            'Webspace', 'Owner/s', 'URL', 'Platform', 'Status', 'Service', 'Created at'
        ];

        $callback = function() use ($webspaces, $columns, $mode, $support){
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($webspaces as $webspace) {
                $platforms = [];
                foreach ($webspace->websites as $website){
                    $platforms[] = $website->platform->name . " " . $website->platform->version;
                }
                $the_platforms = implode(', ', $platforms);
                fputcsv($file,
                [
                    $webspace->name,
                    $webspace->owners->pluck('name')->implode(', '),
                    $webspace->websites->pluck('url')->implode(', '),
                    $the_platforms,
                    $mode->get_webspace_mode($webspace->description_status->mode),
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

    public function import_from_csv(Request $request){
        try{
            Excel::import(new WebspaceImport, $request->file('import-csv-path'));
        }
        catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
            return back()->withError("Invalid spreadsheet file, check the contents of the file");
        }
        catch(\Exception $e){
            return back()->withError($e->validator->errors()->first());
        }

        return redirect()->route('webspace.import')->with('success', 'Webspaces successfully imported');
    }

    /**
     * TODO: create a callback function to execute a function based on the request (webspace|website)
     *       this way, you do not have to reuse function calls for two common functionality with
     *       export_to_csv_webspace
     */

    public function export_to_csv_website(Mode $mode, SupportLevel $support){
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=websites-".time().".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $websites = Website::active()
            ->orderBy('created_at','DESC')
            ->get();

        $columns = [
            'URL', 'Owner/s', 'Platform', 'Status', 'Support Level', 'Webspace', 'Created at'
        ];

        $callback = function() use ($websites, $columns, $mode, $support){
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($websites as $website) {
                //$owner_list = $website->webspace['id']
                if ( $website->webspace['status'] ){
                    fputcsv($file,
                    [
                        $website->url,
                        $website->webspace->owners->pluck('name')->implode(', '),
                        $website->platform->name . " " .$website->platform->version,
                        $mode->get_webspace_mode($website->webspace->description_status->mode),
                        $support->get_webspace_support_level($website->webspace->service),
                        $website->webspace->name,
                        $website->created_at
                    ]);
                }
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);

    }
}
