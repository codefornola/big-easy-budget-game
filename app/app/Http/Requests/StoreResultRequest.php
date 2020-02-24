<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreResultRequest extends Request{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(){
		// Make mongodb the presence verifier (check for duplicate names)
		$this->getValidatorInstance()->getPresenceVerifier()->setConnection('app');
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(){

		return [
			//'user_id'               => 'required|exists:users,_id',
			//'budget_id'             => 'required|exists:budgets,_id',
		];
	}

}
