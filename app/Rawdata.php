<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rawdata extends Model
{
    protected $fillable = [
        'ticket_id', 
        'incident_id', 
        'service_id', 
        'customer', 
        'created_on', 
        'interference_net_duration', 
        'region_sbu',
        'product', 
        'interference',
        'month',
        'week',
        'day'
    ];
}
