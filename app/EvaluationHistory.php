<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationHistory extends Model
{
    //
    protected $table = 'evaluation_historys';

    protected $fillable = [
    	'date', 'data'
    ];
}
