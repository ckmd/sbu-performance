<?php

namespace App\Exports;

use App\RawdataRekon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RawdataRekonExport implements FromCollection, WithHeadings
{
    protected $sbu;
    protected $start;
    protected $end;

    function __construct($sbu, $start, $end) {
        $this->sbu = $sbu;
        $this->start = $start;
        $this->end = $end;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RawdataRekon::where('region_sbu', $this->sbu)
            ->where('created_on','>',$this->start)
            ->where('created_on','<',$this->end)
            ->get([
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
            ]);
    }

    public function headings(): array
    {
        return [
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
}
