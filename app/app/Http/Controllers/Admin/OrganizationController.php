<?php

namespace App\Http\Controllers\Admin;

use Request;
use Image;
use File;
use App\Models\Budget;
use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;

class OrganizationController extends AdminController{

	public function __construct(){
		$this->middleware('filter.input.organization', ['only' => ['store', 'update']]);
	}

	public function index(Budget $budget){
		$title         = $budget->name;
		$organizations = $budget->organizations()->orderBy('name')->get();

		$this->bread([
			route('admin.budgets.show', $budget->id)                => 'Budget',
			route('admin.budgets.organizations.index', $budget->id) => 'Orgs',
		]);

		return view('admin.organizations.index', compact('budget', 'organizations', 'title'));
	}

	public function create(Budget $budget){
		$title   = $budget->name;
		$request = Request::instance();

		$divisions = $request->old('divisions')
			? $request->old('divisions')
			: null;
		$poll      = $this->getPollInput($request);

		$this->bread([
			route('admin.budgets.show', $budget->id)                 => 'Budget',
			route('admin.budgets.organizations.index', $budget->id)  => 'Orgs',
			route('admin.budgets.organizations.create', $budget->id) => 'Add',
		]);

		return view('admin.organizations.create', compact('budget', 'title', 'divisions', 'poll'));
	}

	public function store(StoreOrganizationRequest $request, Budget $budget){

		// Create organization
		$orgData = $this->sanitizeOrgData($this->getOrgInput($request));
		$organization = Organization::create($orgData);

		// Upload photo
		$photo  = $request->file('photo');
		if(!empty($photo) && $photo->isValid()){
			$destPath = public_path($organization->relativeAssetPath());
			if(!File::isDirectory($destPath)){
				File::makeDirectory($destPath, 0775, true);
			}
			$img = Image::make($photo->getPathname());
			$img->fit(360, 180);
			$img->save($destPath . DIRECTORY_SEPARATOR . 'header.jpg', 70);
			unlink($photo->getPathname());
		}

		// Create poll
		$pollData = $this->getPollInput($request);
		if(!$this->pollDataIsEmpty($pollData)){
			$organization->poll()->create($pollData);
		}

		// Add divisions
		if($request->has('divisions')){
			foreach($request->input('divisions') as $division){
				$organization->divisions()->create($division);
			}
		}

		// Save updated organization
		$organization->save();

		return redirect()->route('admin.budgets.organizations.index', $budget->id)
		                 ->with('message', 'Nice work! You added the organization <i>' . e($organization->name) . '</i>')
		                 ->with('alertType', 'info');
	}

	public function show(Budget $budget, Organization $organization){
		dd($organization->units_min);
	}

	public function edit(Budget $budget, Organization $organization){
		$title   = $budget->name;
		$request = Request::instance();

		$divisions = $request->old('divisions')
			? $request->old('divisions')
			: $organization->divisions->toArray();

		$pollArray = $this->getPollInput($request);
		// If there is data in the poll array
		$poll = $request->old('question')
			// Use it
			? $pollArray
			// Otherwise: if poll exists, use data, otherwise send empty pollArray
			: ($organization->poll()->count() ? $organization->poll->toArray() : $pollArray);

		$this->bread([
			route('admin.budgets.show', $budget->id)                => 'Budget',
			route('admin.budgets.organizations.index', $budget->id) => 'Orgs',
			route('admin.budgets.organizations.edit', $budget->id)  => 'Edit',
		]);

		return view('admin.organizations.edit', compact('budget', 'title', 'organization', 'divisions', 'poll'));
	}

	public function update(UpdateOrganizationRequest $request, Budget $budget, Organization $organization){

		// Update organization
		$orgData = $this->sanitizeOrgData($this->getOrgInput($request));
		$organization->update($orgData);

		// Upload photo
		$photo  = $request->file('photo');
		if(!empty($photo) && $photo->isValid()){
            $destPath = public_path($organization->relativeAssetPath());
			if(!File::isDirectory($destPath)){
				File::makeDirectory($destPath, 0775, true);
			}
			$img = Image::make($photo->getPathname());
			$img->fit(360, 180);
			$img->save($destPath . DIRECTORY_SEPARATOR . 'header.jpg', 70);
			unlink($photo->getPathname());
		}

		// Update/create poll
		$pollData = $this->getPollInput($request);
		if(!$this->pollDataIsEmpty($pollData)){
			$organization->poll()->count()
				? $organization->poll->update($pollData)
				: $organization->poll()->create($pollData);
		}elseif($organization->poll()->count()){
			$organization->poll->delete();
		}

		// Remove divisions
		$organization->divisions()->delete();
		// Recreate divisions
		if($request->has('divisions')){
			foreach($request->input('divisions') as $division){
				$organization->divisions()->create($division);
			}
		}
		// Save updated organization
		$organization->save();

		return redirect()->route('admin.budgets.organizations.index', $budget->id)
		                 ->with('message', 'Nice work! You updated the organization <i>' . e($organization->name) . '</i>')
		                 ->with('alertType', 'info');

	}


	public function sanitizeOrgData($data){

		// Fix category id
		if(empty($data['category_id'])) $data['category_id'] = NULL;

		// Fix ints
		$ints = ['units_min', 'units_previous_period', 'units_other_funding'];
		foreach($ints as $int){
			$data[$int] = (int)filter_var($data[$int], FILTER_SANITIZE_NUMBER_INT);
		}

		return $data;
	}

	public function destroy(Budget $budget, Organization $organization){
		$organization->delete();
		$organizations = $budget->organizations;

		return view('admin.organizations.sections.list', compact('budget', 'organizations'));
	}

	public function getPollInput($request){
		return [
			'question' => $request->input('question'),
			'option_a' => $request->input('option_a'),
			'option_b' => $request->input('option_b'),
			'option_c' => $request->input('option_c'),
			'option_d' => $request->input('option_d'),
			'option_e' => $request->input('option_e'),
			'disable_other' => $request->has('disable_other') ? true : false
		];
	}

	public function pollDataIsEmpty($data){
		// Get poll request values only and filter empty ones to see if any data actually exists
		return !count(array_filter(array_values($data)));
	}

	public function getOrgInput($request){
		return $request->except(['divisions', 'question', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e', 'disable_other', 'photo']);
	}

}
