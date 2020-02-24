<?php namespace App\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class Category extends Eloquent{

//	protected $connection = 'mongodb';
	protected $collection = 'categories';
	protected $guarded = [];

	public function budget(){
		return $this->belongsTo('App\Models\Budget');
	}

	public function organizations(){
		return $this->hasMany('App\Models\Organization');
	}

}
