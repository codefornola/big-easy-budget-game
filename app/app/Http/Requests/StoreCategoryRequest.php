<?php

namespace App\Http\Requests;

class StoreCategoryRequest extends Request{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(){
		// Make mongodb the presence verifier (check for duplicate names)
		$this->getValidatorInstance()->getPresenceVerifier()->setConnection('app');

		// Run only if user is admin
		return $this->user()->is('admin');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(){

		return [
			'name'        => 'required',
			'budget_id'   => 'required|exists:budgets,_id',
			'color'       => 'required',
			'description' => 'required',
		];
	}

}
