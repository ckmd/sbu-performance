<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RawdataImport;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RawdataExport;
use App\Rawdata;
use Carbon\Carbon;

class RawdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rawdata.index');
        //
    }

    public function alldata()
    {
        return view('rawdata.alldata');
        // $datas = Rawdata::orderBy('Incident ID')->paginate(2);
        // return view('rawdata.alldata',compact('datas'));
    }
    public function alldataList()
    {
        ini_set('upload_max_filesize', '200M');
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);

        // $rawDatas = Rawdata::get()->unique('Ticket ID')->values()->all();
        $rawDatas = Rawdata::all();
        return Datatables::of($rawDatas)->make(true);
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
 
		// upload ke folder file_sbu di dalam folder public
		$file->move('file_sbu',$nama_file);
 
		// import data
		Excel::import(new RawdataImport, public_path('/file_sbu/'.$nama_file));
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
        // filter hilangkan duplikasi berdasatrkan kolom ...
        // alihkan halaman kembali
        return redirect('/home');
    }

    public function export_rawdata(Request $request)
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

        return Excel::download(new RawdataExport($sbu, $start, $endPlusOne), 'rawdata-query-result.xlsx');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function delete(){
        ini_set('memory_limit', '-1');
        $rawdata = Rawdata::all();
        foreach($rawdata as $item){
            $item->delete();
        }
        return redirect('/alldata');
     }

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
