<?php

namespace App\Http\Controllers;
use App\Webspace;
use Carbon\Carbon;

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

        $the_webspaces = Webspace::active()->get();

        $last_30_days_webspace = Webspace::active()
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        $active_webspaces = Webspace::active()
            ->where('mode',0)
            ->get();

        $disabled_webspaces = Webspace::active()
            ->where('mode',1)
            ->get();


        return view('dashboard', compact(
            'the_webspaces','last_30_days_webspace', 'active_webspaces','disabled_webspaces'
        ));
    }

    public function get_platform_webspace(){
        //$the_webspaces = Webspace::active()->get();
        $data = [
            'series' => [5, 3, 4]
        ];
        return response()->json($data);
    }
}
