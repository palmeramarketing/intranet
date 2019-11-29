<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icons extends Model
{
    //
    protected $table = 'material_icons';

    protected $fillable = [
        'name'
    ];
}
