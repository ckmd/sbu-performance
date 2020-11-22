<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel_IOFactory;
use DateTime;
use App\Excel;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serpo.excel');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Excel::all();
        return view('serpo.download', compact('datas'));
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
        // in case maks upload to server 2MB, dirubah ke 20MB
        // ini_set('upload_max_filesize', '20M');
        ini_set('memory_limit', '-1');
        // Delete Database Sebelum Upload Baru
        // Excel::truncate();
        
        // maksimum time limit 900 seconds, bisa disesuaikan
        ini_set('max_execution_time', 900);
        
        function getDateTime($code, $paramsArray){
            $tempArray = array();
            for ($j=0; $j < strlen($paramsArray)/20 ; $j++) {
                $start = $j*20;
                $tempArray[$code.$j] = substr($paramsArray,$start,20);
            }
            return $tempArray;
        }

        // Method untuk menrubah Selisih menjadi menit
        function filterMinute($dateDiff){
            $value = null;
            if($dateDiff->days == 0 && $dateDiff->h == 0 && $dateDiff->i == 0 && $dateDiff->s == 0){
            }
            else{
                $value += $dateDiff->i + ($dateDiff->h * 60) + ($dateDiff->days * 24 * 60);
                if($dateDiff->s>0){
                    $value += ($dateDiff->s/60);
                }
            }    
            return $value;
        }
        
        $getSheet = null;
        $highestRow = null;
        if(isset($_FILES['excelFile']) && !empty($_FILES['excelFile']['tmp_name']))
        {
            $excelObject = PHPExcel_IOFactory::load($_FILES['excelFile']['tmp_name']);
            $getSheet = $excelObject->getActiveSheet()->toArray(null);
            $highestRow = $excelObject->setActiveSheetIndex(0)->getHighestDataRow();
        }
        
        for ($i = 1; $i < $highestRow; $i++) { 
            if ($getSheet[$i][0] != '') {
                $arrayStartTravel = null;
                $arrayStartWork = null;
                $arrayComplete = null;
                $rsps = 0;
                $wo_complete = null;
                // <!-- Menghitung Durasi SBU -->
                // <!-- Selisih Antara AR_Date dengan WO Date -->
                $SBU = null;
                $AR_Date = new DateTime($getSheet[$i][8]); // Default Format
                $WO_Date = new DateTime($getSheet[$i][9]);
                // $WO_Date = DateTime::createFromFormat('d M Y H:i:s',$getSheet[$i][9]); // Custom Format
                
                // Filter By kode_wo dan wo_cancelled Starts Here
                $filteredDate = Excel::where('kode_wo',$getSheet[$i][2])->value('kode_wo');
                if($filteredDate!=$getSheet[$i][2] && $getSheet[$i][16]!=''){
                    $SBU = date_diff($WO_Date, $AR_Date);
                    $SBU = filterMinute($SBU);
                    $rsps += 25;
                    // Code untuk menghitung preparation time
                    if($getSheet[$i][11]==''){
                        if($getSheet[$i][12]==''){
                            if($getSheet[$i][16]==''){
                                $prepTime = null; // filter jika complete time kosong
                            }else{
                                $stringStartTravel = str_replace(array( '(', ')' ), '', $getSheet[$i][16]); //ambil selisih dari WO date s.d. complete
                                $arrayStartTravel = getDateTime('st', $stringStartTravel);
                                $startTravel = new DateTime($arrayStartTravel['st0']);
                                $prepTime = round(filterMinute(date_diff($WO_Date, $startTravel)),2);
                            }
                        }
                    }else{
                        $stringStartTravel = str_replace(array( '(', ')' ), '', $getSheet[$i][11]);
                        $arrayStartTravel = getDateTime('st', $stringStartTravel);
                        $startTravel = new DateTime($arrayStartTravel['st0']);
                        $prepTime = round(filterMinute(date_diff($WO_Date, $startTravel)),2);
                        $rsps += 25;
                    }
                    
                    // Code untuk Menghitung Travel Time
                    $startWork = null;
                    if($getSheet[$i][12]=='' || $getSheet[$i][11]==''){
                        if($getSheet[$i][16]==''){
                            $travelTime = null;
                        }else{
                            $stringStartWork = str_replace(array( '(', ')' ), '', $getSheet[$i][16]);
                            $arrayStartWork = getDateTime('sw', $stringStartWork);
                            $startWork = new DateTime($arrayStartWork['sw0']);
                            $travelTime = date_diff($startTravel, $startWork);
                            $travelTime = round(filterMinute($travelTime),2);                                
                        }
                    }else{
                        $stringStartWork = str_replace(array( '(', ')' ), '', $getSheet[$i][12]);
                        $arrayStartWork = getDateTime('sw', $stringStartWork);
                        $startWork = new DateTime($arrayStartWork['sw0']);
                        $travelTime = date_diff($startTravel, $startWork);
                        $travelTime = round(filterMinute($travelTime),2);
                        $rsps += 25;
                    }

                    // Code untuk menghitung Working time
                    $stringComplete = str_replace(array( '(', ')' ), '', $getSheet[$i][16]);
                    if($getSheet[$i][16]=='' || $getSheet[$i][12]==''){
                        $workTime = null;
                    }else{
                        $stringStartWork = str_replace(array( '(', ')' ), '', $getSheet[$i][12]);
                        $arrayStartWork = getDateTime('sw', $stringStartWork);
                        $startWork = new DateTime($arrayStartWork['sw0']);

                        $arrayComplete = getDateTime('cp',$stringComplete);
                        $complete = new DateTime($arrayComplete['cp0']);
                        $workTime = date_diff($startWork, $complete);
                        $workTime = round(filterMinute($workTime),2);
                        $rsps += 25;
                    }
                    // Menghitung wo complete
                    if($getSheet[$i][16]!=null){
                        $completeArr = getDateTime('complete',$stringComplete);
                        $wo_complete = new DateTime(end($completeArr));
                    }
                    // stop clock starts here
                    $stringStopClock = str_replace(array( '(', ')' ), '', $getSheet[$i][14]);
                    $arrayStopClock = getDateTime('sc',$stringStopClock);
                    if($arrayStartTravel != null && $arrayStartWork != null && $arrayComplete != null){
                        $arrayMerge = array_merge($arrayStartTravel, $arrayStartWork, $arrayComplete);
                        foreach ($arrayStopClock as $key => $value) {
                            // Filter untuk anomalli data (timestamp stopclock diluar timestamp complete)
                            if(new DateTime($value) >= $complete){
                                continue;
                            }else{
                                $tempAm = array();
                                foreach ($arrayMerge as $am => $arr) {
                                    if(new DateTime($arr) > new DateTime($value)){
                                        $tempSCValue = round(filterMinute(date_diff(new DateTime($value),new DateTime($arr))),2);
                                        $tempAm[$am] = $tempSCValue;
                                    }
                                }
                                $minValue = round(min($tempAm),2);
                                $indeks = array_search(min($tempAm),$tempAm);
                                // return $tempAm;
                                // return $key.' :: '.$value.' , '.$indeks.' :: '.$minValue;
                                if($indeks == 'st0' && $prepTime > $minValue){
                                    $prepTime -= $minValue;
                                }else if(substr($indeks,0,2)=='st' && $travelTime > $minValue){
                                    $travelTime -= $minValue;
                                }else if(substr($indeks,0,2)=='sw' && $workTime > $minValue){
                                    $workTime -= $minValue;
                                }
                            }
                        }
                    }

                //Menghitung Total durasi starts here
                $total_durasi_serpo = null;
                $category = null;
                $root_cause = null;
                $kendala = null;
                $terminasi_pop = null;
                $total_durasi_sc = null;
                $total_durasi_serpo = $prepTime + $travelTime + $workTime;
                // Category setiap root cause
                if($getSheet[$i][24]!=null){
                    $category = $getSheet[$i][24];
                }
                // Root cause diperoleh dari kolom root cause
                if($getSheet[$i][25]!=null){
                    $root_cause = $getSheet[$i][25];
                    // $root_cause = findRootCause($getSheet[$i][23]);
                }
                // kendala diperoleh dari kolom kendala
                if($getSheet[$i][26]!=null){
                    $kendala = $getSheet[$i][26];
                    // $kendala = findKendala($getSheet[$i][20]);
                }
                // terminasi pop diperoleh dari kolom terminasi pop
                if($getSheet[$i][27]!=null){
                    $terminasi_pop = $getSheet[$i][27];
                }
                // filter untuk total sc apabila kosong
                if($getSheet[$i][29]!=null){
                    $total_durasi_sc = $getSheet[$i][29];
                }
                // code untuk menyimpan ke db (tabel excel)
                $data = new Excel();
                    $data->ar_id = $getSheet[$i][0];
                    $data->prob_id = $getSheet[$i][1];
                    $data->kode_wo = $getSheet[$i][2];
                    $data->region = $getSheet[$i][5];
                    $data->basecamp = $getSheet[$i][6];
                    $data->serpo = $getSheet[$i][7];
                    $data->wo_date = $WO_Date;
                    $data->wo_complete = $wo_complete;
                    $data->durasi_sbu = $SBU;
                    $data->prep_time = $prepTime;
                    $data->travel_time = $travelTime;
                    $data->work_time = $workTime;
                    $data->rsps = $rsps/100;
                    $data->total_durasi_serpo = $total_durasi_serpo;
                    $data->total_durasi_wo = $total_durasi_serpo + $SBU;
                    $data->total_durasi_sc = $total_durasi_sc;
                    $data->category = $category;
                    $data->root_cause = $root_cause;
                    $data->kendala = $kendala;
                    $data->terminasi_pop = $terminasi_pop;
                    $data->root_cause_description = $getSheet[$i][23];
                    $data->kendala_description = $getSheet[$i][20];
                    $data->save();
                }
            }
        }
        return redirect()->route('allData.index');
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

    public function delete()
    {
        Excel::truncate();
        return redirect('allData');
    }
}
