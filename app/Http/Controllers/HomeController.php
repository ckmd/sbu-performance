<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rawdata;
use App\Kpi;

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
        $showChart = false;
        return view('home',compact('firstData', 'lastData', 'sbuRegion','showChart'));
    }
    public function message(Request $request)
    {
        // agar dapat mengupload hingga 200MB dan waktu tunggu sampai 900 detik
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);

        // filter apabila tidak memilih sbu manapun
        if($request->sbu == ""){
            return redirect('home');
        }
        $showChart = true;
        // mengambil nilai kpi yang terakhir kali dirubah
        $latestKpi = Kpi::orderBy('created_at', 'desc')->first()["Nilai kpi"];

        $firstData = Rawdata::orderBy('Created On', 'asc')->first()["Created On"];
        $lastData = Rawdata::orderBy('Created On', 'desc')->first()["Created On"];
        $sbuRegion = Rawdata::distinct('Region SBU (Terminating) (Address)')->pluck('Region SBU (Terminating) (Address)');

        // start filter per bulan
        // filter per bulan berdasarkan SBU
        $sbu = $request->sbu;
        $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)->get();
        $groupbyMonth = $rawdataFilteredBySBU->groupBy('Bulan');

        // data per bulan nasional tanpa filter
        $nationalGroupbyMonth = Rawdata::get()->groupBy('Bulan');

        // secara nasional
        foreach ($nationalGroupbyMonth as $key => $gbm){
            $avg = round(collect($gbm->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
            $nationalBulanVal[] = $avg;
        }
        // per sbu
        foreach ($groupbyMonth as $key => $gbm){
            $avg = round(collect($gbm->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
            $kpiVal[] = $latestKpi;
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
            $avg = round(collect($gbw->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
            $nationalMingguVal[] = $avg;
        }
        // per sbu
        foreach ($groupbyWeek as $key => $gbw){
            $avg = round(collect($gbw->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
            $mingguKe[] = $key;
            $mingguVal[] = $avg;
        }
        // end filter per minggu

        // start filter per hari
        // filter berdasarkan SBU
        $sbu = $request->sbu;
        $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)->get();
        $groupbyDay = $rawdataFilteredBySBU->groupBy('Hari');

        // data nasional tanpa filter
        $nationalGroupbyDay = Rawdata::get()->groupBy('Hari');
        // secara nasional
        foreach ($nationalGroupbyDay as $key => $gbd){
            $avg = round(collect($gbd->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
            $nationalHariVal[] = $avg;
        }
        // per sbu
        foreach ($groupbyDay as $key => $gbd){
            $avg = round(collect($gbd->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
            $hariKe[] = $key;
            $hariVal[] = $avg;
        }
        // end filter per hari

        // menghitung nilai KPI nasional dan sbu
        $realisasiBulananKpiNasional = round(collect($nationalBulanVal)->avg(),0);
        $realisasiBulananKpiSBU = round(collect($bulanVal)->avg(),0);

        $realisasiMingguanKpiNasional = round(collect($nationalMingguVal)->avg(),0);
        $realisasiMingguanKpiSBU = round(collect($mingguVal)->avg(),0);

        $realisasiHarianKpiNasional = round(collect($nationalHariVal)->avg(),0);
        $realisasiHarianKpiSBU = round(collect($hariVal)->avg(),0);

        return view('home',compact(
            'sbu',
            'firstData', 
            'lastData', 'kpiVal',
            'sbuRegion','showChart',
            'hariKe','hariVal', 'nationalHariVal',
            'mingguKe','mingguVal', 'nationalMingguVal',
            'bulanKe','bulanVal', 'nationalBulanVal',
            'realisasiBulananKpiNasional', 'realisasiBulananKpiSBU',
            'realisasiMingguanKpiNasional', 'realisasiMingguanKpiSBU',
            'realisasiHarianKpiNasional', 'realisasiHarianKpiSBU'
        ));
        // sampe sini, membuat array / object dari hasil rata2

        // return array('msg'=> $sbu,'mingguKe' => $mingguKe,'mingguVal' => $mingguVal);
        // return response()->json(array('msg'=> $sbu,'mingguKe' => $mingguKe), 200);
    }
}
