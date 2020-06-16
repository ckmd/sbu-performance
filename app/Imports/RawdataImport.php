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
        return new Rawdata([
            'ticket id' => $row['ui'],
            'incident id' => $row['iu'],
        ]);
    }
}
