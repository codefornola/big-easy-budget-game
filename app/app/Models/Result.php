<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Result extends Model {

//	protected $connection = 'mongodb';
	protected $guarded = [];
	protected $dates      = ['created_at', 'updated_at', 'start_time', 'end_time'];

	public function user(){
		return $this->belongsTo('App\Models\User');
	}

	public function budget(){
		return $this->belongsTo('App\Models\Budget');
	}

	public function allocations(){
		return $this->embedsMany('App\Models\Result\Allocation');
	}

}