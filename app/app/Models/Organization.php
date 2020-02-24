<?php

namespace App\Models;

use File;
use Jenssegers\Mongodb\Model as Eloquent;

class Organization extends Eloquent{

//	protected $connection = 'mongodb';
	protected $guarded = [];
	protected $casts = [
		'units_min' => 'int',
		'units_previous_year' => 'int',
		'units_other_funding' => 'int',
	];

	public function budget(){
		return $this->belongsTo('App\Models\Budget');
	}

	public function category(){
		return $this->belongsTo('App\Models\Category');
	}

	public function poll(){
		return $this->embedsOne('App\Models\Organization\Poll');
	}

	public function divisions(){
		return $this->embedsMany('App\Models\Organization\Division');
	}

	public function headerImgExists(){
		return File::exists(public_path($this->headerImgPathRelative()));
	}

	public function headerImgPathRelative(){
		return $this->relativeAssetPath() . "/header.jpg";
	}

	public function relativeAssetPath(){
        $account = app('Account');
        return ltrim($account->assetPath("budget/{$this->budget->id}/org/{$this->id}"), '/');
    }

	public function headerImgPath(){
		return asset($this->headerImgPathRelative());
	}

}
