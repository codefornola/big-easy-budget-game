<?php namespace App\Http\Controllers\Ajax;

use App\Models\Organization;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller{

	public function details(Organization $org){
		if($org){
			return response()->json([
				'org' => $org,
				'content' => (string)view('game.partials.org-details', compact('org'))
			]);
		}
	}

}