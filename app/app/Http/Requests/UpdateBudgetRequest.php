<?php

namespace App\Http\Requests;

class UpdateBudgetRequest extends StoreBudgetRequest{

	public function rules(){

		$rules = parent::rules();
		$budget = $this->route('budgets');
		$rules['name'] .= ",name,{$budget->_id},_id";

		return $rules;
	}

}
