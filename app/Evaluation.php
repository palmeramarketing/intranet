<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //
    protected $table = 'evaluations';

    protected $fillable = [
    	'id_user', 'id_evaluator', 'evaluated', 'id_question', 'value',
    ];
    // public static function existenceCheck()
    // {
    // 	if()
    // 	{
    // 		return false;
    // 	}
    // 	else
    // 	{
    // 		return true;
    // 	}
    // }
}
