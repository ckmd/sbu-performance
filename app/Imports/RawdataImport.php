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
        // $buffer = $createdOn;
        // $createdOnPlusOneDay = $buffer->modify('+1 day');
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
            'Service ID Status' => $row['service_id_status'], 
            'Product' => $row['product'], 
            'Interference Cause (Incident ID) (Incident)' => $row['interference_cause_incident_id_incident'],
            'Address (Terminating) (Address)' => $row['address_terminating_address'], 
            'Province (Terminating) (Address)' => $row['province_terminating_address'], 
            'State (Terminating) (Address)' => $row['state_terminating_address'], 
            'Bandwidth' => $row['bandwidth'], 
            'Address' => $row['address'],
            'Stop Clock Duration' => $row['stop_clock_duration'], 
            'Ticket Type' => $row['ticket_type'], 
            'Interference (Incident ID) (Incident)' => $row['interference_incident_id_incident'], 
            'Interference Net Duration (DurationId) (Duration)' => $row['interference_net_duration_durationid_duration'],
            'Interference Location (Incident ID) (Incident)' => $row['interference_location_incident_id_incident'], 
            'Summary Problem' => $row['summary_problem'], 
            'SBU Owner (Activation List Number) (Activation List)' => $row['sbu_owner_activation_list_number_activation_list'], 
            'Customer Group' => $row['customer_group'],
            'Description (Customer Segment) (Segment)' => $row['description_customer_segment_segment'], 
            'Team Issue' => $row['team_issue'], 
            'Total Amount (Activation List Number) (Activation List)' => $row['total_amount_activation_list_number_activation_list'], 
            'Status Reason' => $row['status_reason'], 
            'Status' => $row['status'],
            'Bulan' => date_format($createdOn, "F"),
            'Minggu' => Carbon::instance($createdOn)->endOfWeek(Carbon::SATURDAY)->weekOfYear,
            'Hari' => Carbon::instance($createdOn)->format('d-m-Y'),
        ]);
    }
}
