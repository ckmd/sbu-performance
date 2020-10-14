<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisAkun extends Model
{

    protected $fillable = [
        'nama'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
    //
}
