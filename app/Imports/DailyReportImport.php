<?php

namespace App\Imports;

use App\DailyReport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DailyReportImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row['ticket_id'])){
            return new DailyReport([
                'ticket_id' => $row['ticket_id'],
                'incident_id' => $row['incident_id'],
                'interference_time' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['interference_time']),
                'region_sbu' => $row['region_sbu_terminating_address'],
                'service_id' => $row['service_id'],
                'customer' => $row['customer'],
                'product' => $row['product'],
                'address_terminating' => $row['address_terminating_address'],
                'summary_problem' => $row['summary_problem'],
                'status_reason' => $row['status_reason'],
                'team_issue' => $row['team_issue'],
                'stop_clock_duration' => $row['stop_clock_duration'],
                'created_on' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['created_on']),
                'close_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['close_date']),
                'interference_net_duration' => $row['interference_net_duration_durationid_duration'],
                'address' => $row['address'],
                'province' => $row['province_terminating_address'],
                'state' => $row['state_terminating_address'],
                'total_amount' => $row['total_amount_activation_list_number_activation_list'],
                'service_id_status' => $row['service_id_status'],
                'bandwidth' => $row['bandwidth'],
            ]);
        }
    }
}
