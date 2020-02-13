<?php

namespace App\Http\Controllers;

use Rinvi\Agent\Agent;

// use Rinvi\Agent\Facades\Agent;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // use Jenssegers\Agent\Agent;

        $agent = new Agent();

        $agents = [

            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'isDesktop' => $agent->isDesktop(),
            'isMobile' => $agent->isMobile(),
            'isPhone' => $agent->isPhone(),
            'isTablet' => $agent->isTablet(),
        ];
        dd($agents);
        return view('home');
    }
}
