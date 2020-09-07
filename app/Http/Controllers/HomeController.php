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
        // mengambil data awal, data akhir, dan nama SBU secara dinamis
        $firstData = $this->getFirstData();
        $lastData = $this->getLastData();
        $sbuRegion = $this->getSBUName();
        $showChart = false;

        return view('home',compact('firstData', 'lastData', 'sbuRegion','showChart'));
    }
    
    public function getFirstData(){
        return Rawdata::orderBy('Created On', 'asc')->first()["Created On"];
    }

    public function getLastData(){
        return Rawdata::orderBy('Created On', 'desc')->first()["Created On"];
    }

    public function getSBUName(){
        return Rawdata::distinct('Region SBU (Terminating) (Address)')->pluck('Region SBU (Terminating) (Address)');
    }

    public function message(Request $request)
    {
        // get current month name
        date_default_timezone_set('Asia/Jakarta');
        $current_month = date('F');
        $current_month = 'January';

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

        // mengambil data awal, data akhir, dan nama SBU secara dinamis
        $firstData = $this->getFirstData();
        $lastData = $this->getLastData();
        $sbuRegion = $this->getSBUName();

        // mengambil setiap variabel dari request
        $sbu = $request->sbu;
        $start = $request->start;
        $end = $request->end;
        
        // $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)->get();
        // cek kondisi sesuai dengan filter date
        // apabila terdapat tanggal start dan tanggal end
        if(!is_null($start) && !is_null($end)){
            $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)
                ->where('Created On','>',$start)
                ->where('Created On','<',$end)
                ->OrderBy('Created On','asc')
                ->get();
        }
        // apabila hanya terdapat tanggal start, maka mengambil sampai data terakhir
        else if(!is_null($start)){
            $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)
                ->where('Created On','>',$start)
                ->OrderBy('Created On','asc')
                ->get();
        }
        // apabila hanya terdapat tanggal end, maka mengambil sampai data terawal
        else if(!is_null($end)){
            $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)
                ->where('Created On','<',$end)
                ->OrderBy('Created On','asc')
                ->get();
        }
        // apabila tidak terdapat start dan end, maka mengambil dari data terawal sampai dengan data terakhir
        else{
            $rawdataFilteredBySBU = Rawdata::OrderBy('Created On','asc')
                ->where('Region SBU (Terminating) (Address)', $sbu)
                ->get();
        }

        $groupbyMonth = $rawdataFilteredBySBU->groupBy('Bulan');

        // data per bulan nasional tanpa filter
        $nationalGroupbyMonth = Rawdata::OrderBy('Created On','asc')->get()->groupBy('Bulan');

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
        $rawdataFilteredBySBU = Rawdata::where('Region SBU (Terminating) (Address)', $sbu)->OrderBy('Created On','asc')->get();
        $groupbyWeek = $rawdataFilteredBySBU->groupBy('Minggu');

        // data nasional tanpa filter
        $nationalGroupbyWeek = Rawdata::OrderBy('Created On','asc')->get()->groupBy('Minggu');
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
        $rawdataFilteredBySBU = Rawdata::OrderBy('Created On','asc')->where('Region SBU (Terminating) (Address)', $sbu)->get();
        $groupbyDay = $rawdataFilteredBySBU->where('Bulan',$current_month)->groupBy('Hari');

        // data nasional tanpa filter
        $nationalGroupbyDay = Rawdata::OrderBy('Created On','asc')->get()->where('Bulan',$current_month)->groupBy('Hari');
        // secara nasional
        $nationalHariVal = [];
        if($nationalGroupbyDay->count() > 0){
            foreach ($nationalGroupbyDay as $key => $gbd){
                $avg = round(collect($gbd->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
                $nationalHariVal[] = $avg;
            }
            $realisasiHarianKpiNasional = round(collect($nationalHariVal)->avg(),0);
        }else{
            $realisasiHarianKpiNasional = $latestKpi;
        }
        
        // per sbu
        $hariVal = [];
        $hariKe = [];
        if($groupbyDay->count() > 0){
            foreach ($groupbyDay as $key => $gbd){
                $avg = round(collect($gbd->pluck('Interference Net Duration (DurationId) (Duration)'))->avg(),0);
                $hariKe[] = substr((string)$key,0,2);
                $hariVal[] = $avg;
            }
            $realisasiHarianKpiSBU = round(collect($hariVal)->avg(),0);
        }else{
            $realisasiHarianKpiSBU = $latestKpi;
        }
        // end filter per hari

        // menghitung nilai KPI nasional dan sbu
        $realisasiBulananKpiNasional = round(collect($nationalBulanVal)->avg(),0);
        $realisasiBulananKpiSBU = round(collect($bulanVal)->avg(),0);

        $realisasiMingguanKpiNasional = round(collect($nationalMingguVal)->avg(),0);
        $realisasiMingguanKpiSBU = round(collect($mingguVal)->avg(),0);

        // menghitung nilai persentase realisasi kpi nasional dan sbu
        $prcntBulananKpiNasional = round($latestKpi / $realisasiBulananKpiNasional * 100,0);
        $prcntBulananKpiSBU = round($latestKpi / $realisasiBulananKpiSBU * 100,0);

        $prcntMingguanKpiNasional = round($latestKpi / $realisasiMingguanKpiNasional * 100,0);
        $prcntMingguanKpiSBU = round($latestKpi / $realisasiMingguanKpiSBU * 100,0);

        $prcntHarianKpiNasional = round($latestKpi / $realisasiHarianKpiNasional * 100,0);
        $prcntHarianKpiSBU = round($latestKpi / $realisasiHarianKpiSBU * 100,0);

        return view('home',compact(
            'sbu',
            'firstData', 
            'lastData', 'kpiVal',
            'sbuRegion','showChart',
            'hariKe','hariVal', 'nationalHariVal','current_month',
            'mingguKe','mingguVal', 'nationalMingguVal',
            'bulanKe','bulanVal', 'nationalBulanVal',
            'realisasiBulananKpiNasional', 'realisasiBulananKpiSBU',
            'realisasiMingguanKpiNasional', 'realisasiMingguanKpiSBU',
            'realisasiHarianKpiNasional', 'realisasiHarianKpiSBU',
            'prcntBulananKpiNasional', 'prcntBulananKpiSBU',
            'prcntMingguanKpiNasional', 'prcntMingguanKpiSBU',
            'prcntHarianKpiNasional', 'prcntHarianKpiSBU'
        ));
        // sampe sini, membuat array / object dari hasil rata2

        // return array('msg'=> $sbu,'mingguKe' => $mingguKe,'mingguVal' => $mingguVal);
        // return response()->json(array('msg'=> $sbu,'mingguKe' => $mingguKe), 200);
    }
}
