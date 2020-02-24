<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreBudgetRequest extends Request{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(){
		// Make mongodb the presence verifier (check for duplicate names)
		$this->getValidatorInstance()->getPresenceVerifier()->setConnection('app');

		return $this->user()->is('admin');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(){
		return [
			'name'              => 'required|unique:budgets',
			'is_active'         => 'boolean',
			'started_at'        => 'date',
			'stopped_at'        => 'date|after:started_at',
			'units_label'       => 'required',
			'units_value'       => 'required|integer',
			'units_total'       => 'required|integer',
			'require_spend_all' => 'boolean',
			'video_provider'    => '',
			'video_id'          => 'required_with:video_provider',
			'survey_provider'   => '',
			'survey_id'         => 'required_with:survey_provider',
			'description'       => '',
		];
	}

}
