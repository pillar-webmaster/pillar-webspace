<?php

namespace App\Http\Controllers;
use App\Webspace;
use App\Platform;
use App\Owner;
use App\Department;
use App\User;
use Carbon\Carbon;
use App\WebspaceSupportLevel as SupportLevel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Webspace $webspaces){

        $the_webspaces = Webspace::active()
            ->orderBy('created_at','DESC')
            ->get();

        $last_30_days_webspace = Webspace::active()
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        $active_webspaces = Webspace::active()
            ->where('mode',0)
            ->get();

        $disabled_webspaces = Webspace::active()
            ->where('mode',1)
            ->get();

        //$latest_webspaces = $the_webspaces->chunk(5)->first();

        $platforms = Platform::active()
            ->get();

        $owners = Owner::active()
            ->get();

        $departments = Department::active()
            ->get();

        $users = User::all();

        return view('dashboard', compact(
            'the_webspaces','last_30_days_webspace', 'active_webspaces',
            'disabled_webspaces','platforms','owners','departments','users'
        ));
    }

    public function get_platform_webspace(){
        $platforms = Platform::active()
            ->orderBy('name','DESC')
            ->get();

        $platform_obj = $stat_obj = [];

        // return only unique platform, and its count
        foreach ($platforms as $plat){
            if (empty($stat_obj)){
                $stat_obj[$plat->name] = $plat->webspaces->count();
            }
            else{
                if (array_key_exists($plat->name, $stat_obj)){
                    $stat_obj[$plat->name] = $stat_obj[$plat->name] + $plat->webspaces->count();
                }
                else{
                    $stat_obj[$plat->name] = $plat->webspaces->count();
                }
            }
        }
        // prepare data for chart
        foreach ($stat_obj as $key => $value){
            $platform_obj['name'][]= $key;
            $platform_obj['count'][] = $value;
        }

        return response()->json($platform_obj);
    }

    public function get_webspace_created(){
        $webspaces = Webspace::whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])
            ->active()
            ->get()
            ->groupBy(function($val){
                return Carbon::parse($val->created_at)->format('n');
            });
        $webspaces = $webspaces->toArray();
        $data = [];
        for ( $x = 1; $x <=12; $x++ ){
            if (isset($webspaces[$x])){
                array_push($data, count($webspaces[$x]));
            }
            else{
                array_push($data, 0);
            }
        }

        return response()->json($data);
    }

    public function get_webspace_support(SupportLevel $level){
        $services = $level->all('support_level');
        $data = [];
        foreach($services as $key => $value){
            $data[$value] = Webspace::active()
                ->where('service', $key)
                ->count();
        }
        return response()->json($data);
    }

    public function changelog(){
        return view('pages.changelog');
    }
}
