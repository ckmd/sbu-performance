<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateMail extends Model
{
    protected $fillable = [
        'subject',
        'description',
    ];
}
