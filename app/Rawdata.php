<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rawdata extends Model
{
    protected $fillable = [
        'Ticket ID', 
        'Incident ID', 
        'Service ID', 
        'Customer', 
        'Region SBU (Terminating) (Address)',
        'Created On', 
        'Close Date', 
        'Interference Time', 
    ];
}
        // 'Service ID Status', 'Product', 'Interference Cause (Incident ID) (Incident)',
        // 'Address (Terminating) (Address)', 'Province (Terminating) (Address)', 'State (Terminating) (Address)', 'Bandwidth', 'Address',
        // 'Stop Clock Duration', 'Ticket Type', 'Interference (Incident ID) (Incident)', 'Interference Net Duration (DurationId) (Duration)',
        // 'Interference Location (Incident ID) (Incident)', 'Summary Problem', 'SBU Owner (Activation List Number) (Activation List)', 'Customer Group',
        // 'Description (Customer Segment) (Segment)', 'Team Issue', 'Total Amount (Activation List Number) (Activation List)', 'Status Reason', 'Status'
