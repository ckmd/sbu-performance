<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RawdataRekonImport;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\RawdataRekon;
use App\Kpi;
use App\Sbu;
use App\User;
use App\TemplateMail;
use Carbon\Carbon;
use App\Exports\RawdataRekonExport;

class RawdataRekonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFirstData(){
        return RawdataRekon::orderBy('created_on', 'asc')->first()["created_on"];
    }

    public function getLastData(){
        return RawdataRekon::orderBy('created_on', 'desc')->first()["created_on"];
    }

    public function getSBUName(){
        return RawdataRekon::distinct('region_sbu')->pluck('region_sbu');
    }

    public function dashboardRekon()
    {
        // mengambil data awal, data akhir, dan nama SBU secara dinamis
        $firstData  = $this->getFirstData();
        $lastData   = $this->getLastData();
        $sbuRegion  = $this->getSBUName();
        $showChart  = false;

        return view('rawdata-rekon.dashboard',compact('firstData', 'lastData', 'sbuRegion','showChart'));
    }

    public function index()
    {
        return view('rawdata-rekon.index');
        //
    }

    public function alldata()
    {
        return view('rawdata-rekon.alldata');
        // $datas = Rawdata::orderBy('Incident ID')->paginate(2);
        // return view('rawdata.alldata',compact('datas'));
    }
    public function alldataList()
    {
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);

        // $rawDatas = Rawdata::get()->unique('Ticket ID')->values()->all();
        $rawDatas = RawdataRekon::all();
        return Datatables::of($rawDatas)->make(true);
    }

    public function delete(){
        ini_set('memory_limit', '-1');
        $rawdata = RawdataRekon::all();
        foreach($rawdata as $item){
            $item->delete();
        }
        return redirect('/alldata-rekon');
    }

    public function queryRekon(Request $request)
    {
        // get current month name
        date_default_timezone_set('Asia/Jakarta');
        // $current_month = date('F');
        $now = date('Y-m-d H:i:s');

        // agar dapat mengupload hingga 200MB dan waktu tunggu sampai 900 detik
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);

        // filter apabila tidak memilih sbu manapun
        if($request->sbu == ""){
            return redirect('dashboard-rekon');
        }
        $showChart  = true;

        // mengambil nilai kpi yang terakhir kali dirubah
        $latestKpi  = Kpi::orderBy('created_at', 'desc')->first()["Nilai kpi"];

        // mengambil data awal, data akhir, dan nama SBU secara dinamis
        $firstData  = $this->getFirstData();
        $lastData   = $this->getLastData();
        $sbuRegion  = $this->getSBUName();

        // mengambil setiap variabel dari request
        $sbu        = $request->sbu;
        $start      = $request->start;
        $end        = $request->end;
        $endPlusOne = Carbon::parse($end)->addDays(1);
        
        $rawdataFilteredBySBU   = RawdataRekon::where('region_sbu', $sbu)->OrderBy('created_on','asc')->get();
        $rawdataOriginal        = RawdataRekon::OrderBy('created_on','asc')->get();

        // cek kondisi sesuai dengan filter date
        // apabila terdapat tanggal start dan tanggal end
        if(!is_null($start) && !is_null($end)){
            $rawdataFilteredBySBUdanTanggal = $rawdataFilteredBySBU
                ->where('created_on','>',$start)
                ->where('created_on','<',$endPlusOne);
            $rawdataOriginalFilteredTanggal = $rawdataOriginal
                ->where('created_on','>',$start)
                ->where('created_on','<',$endPlusOne);
        }
        // apabila hanya terdapat tanggal start, maka mengambil sampai data terakhir
        else if(!is_null($start)){
            $rawdataFilteredBySBUdanTanggal = $rawdataFilteredBySBU
                ->where('created_on','>',$start);
            $rawdataOriginalFilteredTanggal = $rawdataOriginal
                ->where('created_on','>',$start);
        }
        // apabila hanya terdapat tanggal end, maka mengambil sampai data terawal
        else if(!is_null($end)){
            $rawdataFilteredBySBUdanTanggal = $rawdataFilteredBySBU
                ->where('created_on','<',$endPlusOne);
            $rawdataOriginalFilteredTanggal = $rawdataOriginal
                ->where('created_on','<',$endPlusOne);
        }
        // apabila tidak terdapat start dan end, maka mengambil dari data terawal sampai dengan data terakhir
        else{
            $rawdataFilteredBySBUdanTanggal = $rawdataFilteredBySBU;
            $rawdataOriginalFilteredTanggal = $rawdataOriginal;
        }
        // mendapatkan bulan terakhir
        $latestMonth    = $rawdataFilteredBySBUdanTanggal->last()->month;

        $groupbyMonth   = $rawdataFilteredBySBUdanTanggal->groupBy('month');

        // data per bulan nasional tanpa filter
        $nationalGroupbyMonth   = $rawdataOriginalFilteredTanggal->groupBy('month');

        // Yeartodate
        $accumulativeCount  = 0;
        $accumulativeTime   = 0;
        foreach ($nationalGroupbyMonth as $key => $gbm){
            $accumulativeCount  += $gbm->count();
            $accumulativeTime   += collect($gbm->pluck('interference_net_duration'))->sum();
            $ytdNasionalVal[]   = round($accumulativeTime / $accumulativeCount,0);
        }
        // per sbu
        $accumulativeCount = 0;
        $accumulativeTime = 0;
        foreach ($groupbyMonth as $key => $gbm){
            $accumulativeCount  += $gbm->count();
            $accumulativeTime   += collect($gbm->pluck('interference_net_duration'))->sum();
            $ytdBulanKe[]       = $key;
            $ytdSBUVal[]        = round($accumulativeTime / $accumulativeCount,0);
        }
        // end year to date

        // Monthly
        // secara nasional
        foreach ($nationalGroupbyMonth as $key => $gbm){
            $avg                = round(collect($gbm->pluck('interference_net_duration'))->avg(),0);
            $nationalBulanVal[] = $avg;
        }
        // per sbu
        foreach ($groupbyMonth as $key => $gbm){
            $avg        = round(collect($gbm->pluck('interference_net_duration'))->avg(),0);
            $kpiVal[]   = $latestKpi;
            $bulanKe[]  = $key;
            $bulanVal[] = $avg;
        }
        // end monthly

        // weekly
        // filter berdasarkan SBU
        $groupbyWeek            = $rawdataFilteredBySBUdanTanggal->groupBy('week');

        // data nasional tanpa filter
        $nationalGroupbyWeek    = $rawdataOriginalFilteredTanggal->groupBy('week');
        // secara nasional
        foreach ($nationalGroupbyWeek as $key => $gbw){
            $avg                    = round(collect($gbw->pluck('interference_net_duration'))->avg(),0);
            $nationalMingguVal[]    = $avg;
        }
        // per sbu
        foreach ($groupbyWeek as $key => $gbw){
            $avg            = round(collect($gbw->pluck('interference_net_duration'))->avg(),0);
            $mingguKe[]     = $key;
            $mingguVal[]    = $avg;
        }
        // end weekly

        // daily
        // filter berdasarkan SBU
        $groupbyDay         = $rawdataFilteredBySBUdanTanggal->where('month',$latestMonth)->groupBy('day');
        // data nasional tanpa filter
        $nationalGroupbyDay = $rawdataOriginalFilteredTanggal->where('month',$latestMonth)->groupBy('day');

        // secara nasional
        $nationalHariVal    = [];
        foreach ($nationalGroupbyDay as $key => $gbd){
            $avg                = round(collect($gbd->pluck('interference_net_duration'))->avg(),0);
            $nationalHariVal[]  = $avg;
        }
        
        // per sbu
        $hariVal    = [];
        $hariKe     = [];
        foreach ($groupbyDay as $key => $gbd){
            $avg        = round(collect($gbd->pluck('interference_net_duration'))->avg(),0);
            $hariKe[]   = substr((string)$key,0,2);
            $hariVal[]  = $avg;
        }
        // end daily

        // menghitung nilai KPI nasional dan sbu
        $realisasiBulananKpiNasional    = round(collect($nationalBulanVal)->avg(),0);
        $realisasiBulananKpiSBU         = round(collect($bulanVal)->avg(),0);

        $realisasiMingguanKpiNasional   = round(collect($nationalMingguVal)->avg(),0);
        $realisasiMingguanKpiSBU        = round(collect($mingguVal)->avg(),0);

        $realisasiHarianKpiNasional     = round(collect($nationalHariVal)->avg(),0);
        $realisasiHarianKpiSBU          = round(collect($hariVal)->avg(),0);

        // menghitung nilai persentase realisasi kpi nasional dan sbu
        $prcntBulananKpiNasional        = round($latestKpi / $realisasiBulananKpiNasional * 100,0);
        $prcntBulananKpiSBU             = round($latestKpi / $realisasiBulananKpiSBU * 100,0);

        $prcntMingguanKpiNasional       = round($latestKpi / $realisasiMingguanKpiNasional * 100,0);
        $prcntMingguanKpiSBU            = round($latestKpi / $realisasiMingguanKpiSBU * 100,0);

        $prcntHarianKpiNasional         = round($latestKpi / $realisasiHarianKpiNasional * 100,0);
        $prcntHarianKpiSBU              = round($latestKpi / $realisasiHarianKpiSBU * 100,0);

        $sbuId = Sbu::where('nama', $sbu)->get()->first()->id;
        $recipients = User::where('role_id',2)->where('sbu_id',$sbuId)->orWhere('jenis_akun_id',1)->get();
        $templateMail = TemplateMail::first();

        return view('rawdata-rekon.dashboard',compact(
            'sbu','start','end','now', 'latestMonth',
            'firstData', 'lastData', 'kpiVal',
            'sbuRegion','showChart',
            'hariKe','hariVal', 'nationalHariVal',
            'mingguKe','mingguVal', 'nationalMingguVal',
            'bulanKe','bulanVal', 'nationalBulanVal',
            'ytdBulanKe', 'ytdSBUVal', 'ytdNasionalVal',
            'realisasiBulananKpiNasional', 'realisasiBulananKpiSBU',
            'realisasiMingguanKpiNasional', 'realisasiMingguanKpiSBU',
            'realisasiHarianKpiNasional', 'realisasiHarianKpiSBU',
            'prcntBulananKpiNasional', 'prcntBulananKpiSBU',
            'prcntMingguanKpiNasional', 'prcntMingguanKpiSBU',
            'prcntHarianKpiNasional', 'prcntHarianKpiSBU',
            'recipients', 'templateMail'
        ));
        // sampe sini, membuat array / object dari hasil rata2
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        
		// validasi
		// $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);
        // return 'yes';

        // menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_rekon di dalam folder public
		$file->move('file_rekon',$nama_file);
 
		// import data
		Excel::import(new RawdataRekonImport, public_path('/file_rekon/'.$nama_file));
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
        // filter hilangkan duplikasi berdasatrkan kolom ...
        // alihkan halaman kembali
        return redirect('/dashboard-rekon');
        //
    }

    public function export_rawdata_rekon(Request $request)
	{
        $sbu = $request->sbu;
        $start = $request->start;
        $end = $request->end;
        $endPlusOne = Carbon::parse($end)->addDays(1);

        if(is_null($start) && is_null($end)){
            $start = Carbon::createFromFormat('d/m/Y', '01/01/2000');
            $endPlusOne = Carbon::createFromFormat('d/m/Y', '31/12/2030');
        }
        else if(is_null($start)){
            $start = Carbon::createFromFormat('d/m/Y', '01/01/2000');
        }
        else if(is_null($end)){
            $endPlusOne = Carbon::createFromFormat('d/m/Y', '31/12/2030');
        }

        return Excel::download(new RawdataRekonExport($sbu, $start, $endPlusOne), 'rawdata-query-result.xlsx');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
