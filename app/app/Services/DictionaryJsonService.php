<?php namespace App\Services;

class DictionaryJsonService{

	protected $hashMap = [];

	public function add($idKey, $model){
		$this->hashMap[$idKey] = $model;
		return $this;
	}

	public function make($varname){
		return "var $varname = {$this->getMap()};";
	}

	public function filterEmptyField($field){
		foreach($this->hashMap as $key => $model){
			if(empty($model[$field])) unset($this->hashMap[$key]);
		}
		return $this;
	}

	public function getMap(){
		return json_encode($this->hashMap);
	}

}