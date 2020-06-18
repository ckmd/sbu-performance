<?php

namespace App\Imports;

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
        // $reader->;
        return new Rawdata([
            'Ticket ID' => $row['ticket_id'],
            'Incident ID' => $row['incident_id'],
            'Service ID' => $row['service_id'],
            'Customer' => $row['customer'],
            'Region SBU (Terminating) (Address)' => $row['region_sbu_terminating_address'],
            'Created On' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['created_on']),
            'Close Date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['close_date']), 
            'Interference Time' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['interference_time']), 
            // 'Service ID Status' => $row[11], 
            // 'Product' => $row[12], 
            // 'Interference Cause (Incident ID) (Incident)' => $row[13],
            // 'Address (Terminating) (Address)' => $row[14], 
            // 'Province (Terminating) (Address)' => $row[15], 
            // 'State (Terminating) (Address)' => $row[16], 
            // 'Bandwidth' => $row[17], 
            // 'Address' => $row[18],
            // 'Stop Clock Duration' => $row[19], 
            // 'Ticket Type' => $row[20], 
            // 'Interference (Incident ID) (Incident)' => $row[21], 
            // 'Interference Net Duration (DurationId) (Duration)' => $row[22],
            // 'Interference Location (Incident ID) (Incident)' => $row[23], 
            // 'Summary Problem' => $row[24], 
            // 'SBU Owner (Activation List Number) (Activation List)' => $row[25], 
            // 'Customer Group' => $row[26],
            // 'Description (Customer Segment) (Segment)' => $row[27], 
            // 'Team Issue' => $row[28], 
            // 'Total Amount (Activation List Number) (Activation List)' => $row[29], 
            // 'Status Reason' => $row[30], 
            // 'Status' => $row[31],
        ]);
    }
}
