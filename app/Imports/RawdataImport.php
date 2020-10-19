<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Rawdata;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RawdataImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $createdOn = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['created_on']);

        if(!empty($row['ticket_id'])){
            return new Rawdata([
                'ticket_id' => $row['ticket_id'],
                'incident_id' => $row['incident_id'],
                'service_id' => $row['service_id'],
                'customer' => $row['customer'],
                'created_on' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['created_on']),
                'interference_net_duration' => $row['interference_net_duration_durationid_duration'],
                'region_sbu' => $row['region_sbu_terminating_address'],
                'product' => $row['product'], 
                'interference' => $row['interference_incident_id_incident'], 
                'month' => date_format($createdOn, "F"),
                'week' => Carbon::instance($createdOn)->endOfWeek(Carbon::SATURDAY)->weekOfYear,
                'day' => Carbon::instance($createdOn)->format('d-m-Y'),
            ]);
        }
    }
}
