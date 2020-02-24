<?php namespace App\Services;

class IteratorIndexService{

	protected $currentIndex = 0;

	public function increment(){
		$this->currentIndex++;
	}

	public function current(){
		return $this->currentIndex;
	}


	public function real(){
		return $this->currentIndex + 1;
	}
}