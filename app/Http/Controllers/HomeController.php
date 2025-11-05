<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;


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
        $totalUsers = \App\Models\User::count();
        $alertCount = Cache::get('total_alerts', 0);
        $processedJobs = Cache::get('jobs_count', 0);
        $lastSync = now()->format('d/m/Y H:i');
        return view('home', compact('totalUsers', 'alertCount', 'processedJobs', 'lastSync'));
    }
}
