<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeleteKey extends Model
{
    //
    protected $table = 'delete_keys';

    protected $fillable = [
    	'id_user', 'delete_key'
    ];
}
