<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreOrganizationRequest extends Request{

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
			'name'                  => 'required',
			'budget_id'             => 'required|exists:budgets,_id',
			'category_id'           => 'exists:categories,_id',
			'units_min'             => 'required|integer',
			'units_previous_period' => 'required|integer',
			'brief'                 => 'required',
			'photo'                 => 'image',
		];
	}

}
