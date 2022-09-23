<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $approve = Complaint::where('status', 'Approved')->get();
        $waiting = Complaint::where('status', 'Waiting')->get();
        $decline = Complaint::where('status', 'Decline')->get();

        $month = [0,0,0,0,0,0,0,0,0,0,0,0];
        $chart = Complaint::select(
            \DB::raw('count(*) as total'),
            \DB::raw('month')
        )->groupBy('month')->get();

        foreach($chart as $c) {
            $month[$c->month-1] = $c->total;
        }

        // dd($month);

        return view('home', compact('approve', 'waiting', 'decline', 'month'));
    }
}
