<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable = [
        'ticket_id',
        'incident_id',
        'interference_time',
        'region_sbu',
        'service_id',
        'customer',
        'product',
        'address_terminating',
        'summary_problem',
        'status_reason',
        'team_issue',
        'stop_clock_duration',
        'created_on',
        'close_date',
        'interference_net_duration',
        'address',
        'province',
        'state',
        'total_amount',
        'service_id_status',
        'bandwidth',
    ];
}
