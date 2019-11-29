<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardHistory extends Model
{
    //
    protected $table = 'reward_historys';

    protected $fillable = [
    	'from_admin', 'to_user', 'amount', 'description', 'state'
    ];
}
