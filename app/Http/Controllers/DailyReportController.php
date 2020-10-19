<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Sbu;
use App\User;
use App\DailyReport;
use Illuminate\Http\Request;
use App\Imports\DailyReportImport;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
                // mengambil data awal, data akhir, dan nama SBU secara dinamis
        $firstData  = $this->getFirstData();
        $lastData   = $this->getLastData();
        $sbuRegion  = $this->getSBUName();
        $showChart  = false;
        
        return view('daily-report.dashboard',compact('firstData', 'lastData', 'sbuRegion','showChart'));
    }

    public function getFirstData(){
        return DailyReport::orderBy('created_on', 'asc')->first()["created_on"];
    }

    public function getLastData(){
        return DailyReport::orderBy('created_on', 'desc')->first()["created_on"];
    }

    public function getSBUName(){
        return DailyReport::distinct('region_sbu')->pluck('region_sbu')->sort();
    }

    public function index()
    {
        return view('daily-report.index');
        //
    }

    public function query(Request $request){
        // get current month name
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        // agar dapat mengupload hingga 200MB dan waktu tunggu sampai 900 detik
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);

        // filter apabila tidak memilih sbu manapun
        if($request->sbu == ""){
            return redirect()->route('daily-report.index');
        }
        $showChart  = true;

        // mengambil data awal, data akhir, dan nama SBU secara dinamis
        $firstData  = $this->getFirstData();
        $lastData   = $this->getLastData();
        $sbuRegion  = $this->getSBUName();

        // mengambil setiap variabel dari request
        $sbu        = $request->sbu;
        $start      = $request->start;
        $end        = $request->end;
        $endPlusOne = Carbon::parse($end)->addDays(1);

        $sbuId = Sbu::where('nama', $sbu)->get()->first()->id;
        $recipients = User::where('role_id',2)->where('sbu_id',$sbuId)->orWhere('jenis_akun_id',1)->get();

        $dailyReportFilteredBySBU = DailyReport::where('region_sbu', $sbu)
            ->OrderBy('created_on','asc')
            ->get();
        $dailyReportOriginal = DailyReport::OrderBy('created_on','asc')
            ->get();

        // filter start dan end
        // apabila terdapat tanggal start dan tanggal end
        if(!is_null($start) && !is_null($end)){
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU
                ->where('Created On','>',$start)
                ->where('Created On','<',$endPlusOne);
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal
                ->where('Created On','>',$start)
                ->where('Created On','<',$endPlusOne);
        }
        // apabila hanya terdapat tanggal start, maka mengambil sampai data terakhir
        else if(!is_null($start)){
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU
                ->where('Created On','>',$start);
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal
                ->where('Created On','>',$start);
        }
        // apabila hanya terdapat tanggal end, maka mengambil sampai data terawal
        else if(!is_null($end)){
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU
                ->where('Created On','<',$endPlusOne);
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal
                ->where('Created On','<',$endPlusOne);
        }
        // apabila tidak terdapat start dan end, maka mengambil dari data terawal sampai dengan data terakhir
        else{
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU;
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal;
        }

        foreach($dailyReportFilteredBySBUdanTanggal as $item){
            $minuteDiff = Carbon::parse($now)->diffInMinutes(Carbon::parse($item->created_on));

            $dailyReport = DailyReport::find($item->id);
            $dailyReport->interference_net_duration = $minuteDiff;
            $dailyReport->save();
        }

        // refactoring DRY start here
        // dapatkan dailyreport terbaru yang sudah diupdate interference_net_durationnya
        $dailyReportFilteredBySBU = DailyReport::where('region_sbu', $sbu)
            ->OrderBy('created_on','asc')
            ->get();
        $dailyReportOriginal = DailyReport::OrderBy('created_on','asc')
            ->get();

        // filter start dan end
        // apabila terdapat tanggal start dan tanggal end
        if(!is_null($start) && !is_null($end)){
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU
                ->where('Created On','>',$start)
                ->where('Created On','<',$endPlusOne);
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal
                ->where('Created On','>',$start)
                ->where('Created On','<',$endPlusOne);
        }
        // apabila hanya terdapat tanggal start, maka mengambil sampai data terakhir
        else if(!is_null($start)){
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU
                ->where('Created On','>',$start);
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal
                ->where('Created On','>',$start);
        }
        // apabila hanya terdapat tanggal end, maka mengambil sampai data terawal
        else if(!is_null($end)){
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU
                ->where('Created On','<',$endPlusOne);
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal
                ->where('Created On','<',$endPlusOne);
        }
        // apabila tidak terdapat start dan end, maka mengambil dari data terawal sampai dengan data terakhir
        else{
            $dailyReportFilteredBySBUdanTanggal = $dailyReportFilteredBySBU;
            $dailyReportOriginalFilteredTanggal = $dailyReportOriginal;
        }
        // refactoring DRY stop here

        $stopClock = $dailyReportFilteredBySBUdanTanggal->where('status_reason','Stop Clock')->count();
        $progress = $dailyReportFilteredBySBUdanTanggal->where('status_reason','Progress')->count();
        $grandTotal = $stopClock + $progress;
        
        $rataStopClock = round($dailyReportFilteredBySBUdanTanggal->where('status_reason','Stop Clock')->pluck('interference_net_duration')->average(),0);
        $rataProgress = round($dailyReportFilteredBySBUdanTanggal->where('status_reason','Progress')->pluck('interference_net_duration')->average(),0);
        $rataGrandTotal = round($dailyReportFilteredBySBUdanTanggal->whereIn('status_reason',['Progress','Stop Clock'])->pluck('interference_net_duration')->average(),0);

        // code for generate team issue chart
        $teamIssueUnique = $dailyReportFilteredBySBUdanTanggal->where('team_issue','!=', null)->pluck('team_issue')->unique();
        $teamIssueCategory = [];
        $teamIssueValue = [];
        foreach($teamIssueUnique as $key => $value){
            $teamIssueCategory[] = $value;
            $teamIssueValue[] = $dailyReportFilteredBySBUdanTanggal->where('team_issue',$value)->count();
        }

        // code for generate top 3 product
        $topProductUnique = $dailyReportFilteredBySBUdanTanggal->pluck('product')->unique();
        $topProductCategory = [];
        $topProductValueProgress = [];
        $topProductValueStopClock = [];
        foreach($topProductUnique as $key => $value){
            $topProductCategory[] = $value;
            $topProductValueProgress[] = $dailyReportFilteredBySBUdanTanggal->where('status_reason','Progress')->where('product',$value)->count();
            $topProductValueStopClock[] = $dailyReportFilteredBySBUdanTanggal->where('status_reason','Stop Clock')->where('product',$value)->count();
        }
        $top3ProductCategory = array_slice($topProductCategory, 0, 3);
        $top3ProductValueProgress = array_slice($topProductValueProgress, 0, 3);
        $top3ProductValueStopClock = array_slice($topProductValueStopClock, 0, 3);

        return view('daily-report.dashboard',compact(
            'firstData', 
            'lastData', 
            'sbuRegion',
            'showChart',
            'stopClock',
            'progress',
            'grandTotal',
            'rataStopClock',
            'rataProgress',
            'rataGrandTotal',
            'recipients',
            'sbu',
            'start',
            'end',
            'now',
            'dailyReportFilteredBySBUdanTanggal',
            'teamIssueCategory',
            'teamIssueValue',
            'top3ProductCategory',
            'top3ProductValueProgress',
            'top3ProductValueStopClock',
        ));
    }

    public function alldata()
    {
        return view('daily-report.alldata');
    }
    public function alldataList()
    {
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);

        // $rawDatas = Rawdata::get()->unique('Ticket ID')->values()->all();
        $rawDatas = DailyReport::all();
        return Datatables::of($rawDatas)->make(true);
    }

    public function delete()
    {
        ini_set('memory_limit', '-1');
        $rawdata = DailyReport::all();
        foreach($rawdata as $item){
            $item->delete();
        }
        return redirect('/alldata-daily-report');
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
        DailyReport::truncate();
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        
        // menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_sbu di dalam folder public
		$file->move('file_daily_report',$nama_file);
 
		// import data
		Excel::import(new DailyReportImport, public_path('/file_daily_report/'.$nama_file));
 
        return redirect('/daily-report/dashboard');
        //
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
