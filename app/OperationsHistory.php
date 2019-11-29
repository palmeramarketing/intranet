<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationsHistory extends Model
{
    //
    protected $table = 'operations_historys';

    protected $fillable = [
    	'from_user', 'to_user', 'amount', 'description', 'state'
    ];
}
