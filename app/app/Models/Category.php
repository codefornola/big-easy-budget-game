<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model {

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
