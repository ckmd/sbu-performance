<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rawdata;

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
        $firstData = Rawdata::orderBy('Created On', 'asc')->first()["Created On"];
        $lastData = Rawdata::orderBy('Created On', 'desc')->first()["Created On"];
        return view('home',compact('firstData', 'lastData'));
    }
    public function message(Request $request)
    {
        // return $request;
        $msg = $request->sbu;
        return response()->json(array('msg'=> $msg), 200);
    }
}
