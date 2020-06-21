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
        $condition = false;
        return view('home',compact('firstData', 'lastData', 'sbuRegion','condition'));
    }
    public function message(Request $request)
    {
        if($request->sbu == ""){
            return redirect('home');
        }
        $condition = true;
        $firstData = Rawdata::orderBy('Created On', 'asc')->first()["Created On"];
        $lastData = Rawdata::orderBy('Created On', 'desc')->first()["Created On"];
        $sbuRegion = Rawdata::distinct('Region SBU (Terminating) (Address)')->pluck('Region SBU (Terminating) (Address)');

        // start filter per bulan
        // filter berdasarkan SBU
        $sbu = $request->sbu;
        $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)->get();
        $groupbyMonth = $rawdataFilteredBySBU->groupBy('Bulan');

        // data nasional tanpa filter
        $nationalGroupbyMonth = Rawdata::get()->groupBy('Bulan');

        // secara nasional
        foreach ($nationalGroupbyMonth as $key => $gbm){
            $avg = round(collect($gbm->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),2);
            $nationalBulanVal[] = $avg;
        }
        // per sbu
        foreach ($groupbyMonth as $key => $gbm){
            $avg = round(collect($gbm->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),2);
            $bulanKe[] = $key;
            $bulanVal[] = $avg;
        }
        // end filter per bulan

        // start filter per minggu
        // filter berdasarkan SBU
        $sbu = $request->sbu;
        $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)->get();
        $groupbyWeek = $rawdataFilteredBySBU->groupBy('Minggu');

        // data nasional tanpa filter
        $nationalGroupbyWeek = Rawdata::get()->groupBy('Minggu');
        // secara nasional
        foreach ($nationalGroupbyWeek as $key => $gbw){
            $avg = round(collect($gbw->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),2);
            $nationalMingguVal[] = $avg;
        }
        // per sbu
        foreach ($groupbyWeek as $key => $gbw){
            $avg = round(collect($gbw->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),2);
            $mingguKe[] = $key;
            $mingguVal[] = $avg;
        }
        // end filter per minggu
        return view('home',compact(
            'sbu',
            'firstData', 
            'lastData', 
            'sbuRegion','condition','mingguKe','mingguVal', 'nationalMingguVal',
            'bulanKe','bulanVal', 'nationalBulanVal'));
        // sampe sini, membuat array / object dari hasil rata2

        return array('msg'=> $sbu,'mingguKe' => $mingguKe,'mingguVal' => $mingguVal);
        return response()->json(array('msg'=> $sbu,'mingguKe' => $mingguKe), 200);
    }
}
