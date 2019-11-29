<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class PurchaseHistory extends Model
	{
	    //
	    protected $table = 'purchase_historys';

	    protected $fillable = [
	    	'product_id', 'product_name','buyer_user', 'admin', 'state', 'amount',
	    ];
	}