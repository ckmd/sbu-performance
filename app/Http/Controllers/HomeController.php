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
        $sbuRegion = Rawdata::distinct('Region SBU (Terminating) (Address)')->pluck('Region SBU (Terminating) (Address)');
        $val = array(0, 10, 5, 2, 20, 30, 45);
        return view('home',compact('firstData', 'lastData', 'sbuRegion','val'));
    }
    public function message(Request $request)
    {
        $firstData = Rawdata::orderBy('Created On', 'asc')->first()["Created On"];
        $lastData = Rawdata::orderBy('Created On', 'desc')->first()["Created On"];
        $sbuRegion = Rawdata::distinct('Region SBU (Terminating) (Address)')->pluck('Region SBU (Terminating) (Address)');

        // return $request;
        $sbu = $request->sbu;
        $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)->get();
        $groupbyWeek = $rawdataFilteredBySBU->groupBy('Minggu');
        // nasional
        $nationalGroupbyWeek = Rawdata::get()->groupBy('Minggu');
        foreach ($nationalGroupbyWeek as $key => $gbw){
            $avg = round(collect($gbw->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),2);
            $nationalVal[] = $avg;
        }
        // per sbu
        foreach ($groupbyWeek as $key => $gbw){
            $avg = round(collect($gbw->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),2);
            $mingguKe[] = $key;
            $mingguVal[] = $avg;
        }
        $val = array(0, 10, 5, 2, 20, 30, 45);
        return view('home',compact('sbu','firstData', 'lastData', 'sbuRegion','val','mingguKe','mingguVal', 'nationalVal'));
        // sampe sini, membuat array / object dari hasil rata2

        return array('msg'=> $sbu,'mingguKe' => $mingguKe,'mingguVal' => $mingguVal);
        return response()->json(array('msg'=> $sbu,'mingguKe' => $mingguKe), 200);
    }
}
