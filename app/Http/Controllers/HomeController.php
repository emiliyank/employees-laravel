<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

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
        $user = \Auth::user();

        if($user->role == 'manager'){
            return view('manager_home');
        }else{
            $managers = $user->managers;

            return view('home', compact('managers'));
        }
        
    }

    /**
     * Fetch subseravnts data
     *
     * @return Yajra\Datatables\Datatables
     */
    public function subservantsData()
    {
        $user = \Auth::user();
        $employees = $user->subservants;

        return Datatables::of($employees)->make(true);
    }
}
