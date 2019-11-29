<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $table = 'devices';

    protected $fillable = [
    	'name', 'type', 'brand', 'model', 'serial', 'state', 'user'
    ];
}
