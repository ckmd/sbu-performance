<?php
include_once("../xlsxwriter.class.php");
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$filename = "All Data.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$header = array(
    'AR_id'=>'0',
    'Prob_id'=>'0',
    'Kode_WO'=>'0',
    'WO_Date'=>'string',
    'Region'=>'string',
    'Basecamp'=>'string',
    'Serpo'=>'string',
    'Durasi_SBU'=>'0.00',
    'Preparation_Time'=>'0.00',
    'Travel_Time'=>'0.00',
    'Working_Time'=>'0.00',
    'Total Durasi WO'=>'0.00',
    'RSPS'=>'0%',
    'WO Complete'=>'string',
    'Total Durasi SC'=>'string',
    'Category'=>'string',
    'Root Cause'=>'string',
    'Kendala'=>'string',
    'Terminasi POP'=>'string',
);

$rows = array();
                  foreach($datas as $d) {
                  $rows[] = array(
                  "$d->ar_id",
                  "$d->prob_id",
                  "$d->kode_wo",
                  "$d->wo_date",
                  "$d->region",
                  "$d->basecamp",
                  "$d->serpo",
                  "$d->durasi_sbu",
                  "$d->prep_time",
                  "$d->travel_time",
                  "$d->work_time",
                  "$d->total_durasi_wo",
                  "$d->rsps",
                  "$d->wo_complete",
                  "$d->total_durasi_sc",
                  "$d->category",
                  "$d->root_cause",
                  "$d->kendala",
                  "$d->terminasi_pop"
                  );
		}
            $writer = new XLSXWriter();
$writer->setAuthor('icon+'); 
$writer->writeSheetHeader('Sheet1', $header);
foreach($rows as $row)
	$writer->writeSheetRow('Sheet1', $row);
$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
exit(0);