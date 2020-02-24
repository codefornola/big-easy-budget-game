<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use App\Http\Requests\StoreBudgetRequest;
use App\Models\Result;
use App\Services\ReportService;
use Carbon\Carbon;

class BudgetController extends AdminController{

	public function __construct(){
		$this->middleware('filter.input.budget', ['only' => ['store', 'update']]);
	}

	public function index(){
		$budgets = Budget::orderby('is_active', 'desc')->orderby('created_at', 'desc')->get();
		return view('admin.budgets.index', compact('budgets'));
	}

	public function create(){
		return view('admin.budgets.create');
	}

	public function store(StoreBudgetRequest $request){
		$data   = $this->getBudgetInput($request);
		$data   = $this->sanitizeBudgetData($data);
		$budget = Budget::create($data);

		$cloneId = $request->input('clone_budget_id');
		if(!empty($cloneId)){

			$template = Budget::find($cloneId);

			foreach($template->categories()->with('organizations')->get() as $cat){

				$catClone            = $cat->replicate();
				$catClone->budget_id = $budget->_id;
				$catClone->save();

				$categoryOrgs = $cat->organizations;
				$this->copyOrganizationsToBudget($budget, $categoryOrgs, $catClone->id);

			}

			$nonCategoryOrgs = $template->organizations()->where('category_id', '=', '')->get();
			$this->copyOrganizationsToBudget($budget, $nonCategoryOrgs);

		}

		return redirect()->route('admin.budgets.organizations.index', $budget->id)
		                 ->with('message', 'Well done! You created the budget <i>' . e($budget->name) . '</i>')
		                 ->with('alertType', 'info');
	}

	public function copyOrganizationsToBudget($newBudget, $organizations, $withCategoryId = ''){
		foreach($organizations as $org){
			$orgClone              = $org->replicate();
			$orgClone->budget_id   = $newBudget->_id;
			$orgClone->category_id = $withCategoryId;

			if(!empty($orgClone->poll)){
				$orgClone->poll()->save($orgClone->poll->replicate());
			}

			if(!empty($orgClone->divisions)){
				foreach($orgClone->divisions as $div){
					$divClone = $div->replicate();
					$orgClone->divisions()->dissociate($div);
					$orgClone->divisions()->associate($divClone);
				}
			}

			$orgClone->save();
		}
	}

	public function show(Budget $budget){
		$title = $budget->name;
		$stats = $budget->getAggregateData();
		return view('admin.budgets.show', compact('budget', 'title', 'stats'))
			->with('graph', $this->getGraphData($stats));
//			->with('table', $this->getTableData($stats));
	}

	public function download(Budget $budget, $type){

		switch($type){
			case 'report':
				$report = new ReportService($budget);
				$report->import($budget)->downloadAs($report->defaultReportFilename(), 'csv');
				break;
		}

	}

	public function edit(Budget $budget){
		$title = $budget->name;

		return view('admin.budgets.edit', compact('budget', 'title'));
	}

	public function update(UpdateBudgetRequest $request, Budget $budget){

		// Update budget
		$data   = $this->getBudgetInput($request) + ['is_active' => $budget->is_active];
		$data   = $this->sanitizeBudgetData($data);
		$budget->update($data);

		return redirect()->route('admin.budgets.show', $budget->id)
		                 ->with('message', 'Got it! Your settings were saved.')
		                 ->with('alertType', 'info');

	}

	public function open(Budget $budget){

		$update = ['is_active' => true];
		// Update budget
		if(empty($budget->opened_at)){
			$update['opened_at'] = Carbon::now();
		}
		$budget->update($update);

		return redirect()->back()
		                 ->with('message', '<i>' . e($budget->name) . '</i> is now open to users!')
		                 ->with('alertType', 'success');

	}

	public function pause(Budget $budget){

		// Update budget
		$budget->update(['is_active' => false]);

		return redirect()->back()
		                 ->with('message', '<i>' . e($budget->name) . '</i> is now paused.')
		                 ->with('alertType', 'info');
	}


	public function close(Budget $budget){

		// Update budget
		$budget->update(['closed_at' => Carbon::now(), 'is_active' => false]);

		return redirect()->back()
		                 ->with('message', '<i>' . e($budget->name) . '</i> is now closed.')
		                 ->with('alertType', 'danger');
	}

	public function destroy(Budget $budget){
		$budget->delete();
		$budgets = Budget::orderby('is_active', 'desc')->orderby('created_at', 'desc')->get();

		return view('admin.budgets.sections.list', compact('budgets'));
	}

	public function getBudgetInput($request){
		return $request->except(['clone_budget_id']);
	}

	public function sanitizeBudgetData($data){

		// Fix ints
		$ints = ['units_value', 'units_total'];
		foreach($ints as $int){
			$data[$int] = (int)filter_var($data[$int], FILTER_SANITIZE_NUMBER_INT);
		}

		// Make checkboxes boolean
		$data['is_active']         = (isset($data['is_active']) && !empty($data['is_active'])) ? true : false;
		$data['require_spend_all'] = (isset($data['require_spend_all']) && !empty($data['require_spend_all'])) ? true : false;

		return $data;
	}

	public function getGraphData($stats)
	{
		$graph = [
			'dates'     => [],
			'times'     => [],
			'completes' => [],
		];

		$dataDays = [];
		foreach ($stats['latestActivity'] as $day) {
			$dataDays[$day['_id']['month'] . '/' . $day['_id']['day']] = $day;
		}

		$daysBack  = 14;
		$daySeries = new Carbon();
		$daySeries->subDays($daysBack-1);// fix for zero index so "today" is included
		while ($daysBack) {

			$dayMonthStr = $daySeries->format("n/j");

			$graph['dates'][] = $dayMonthStr;

			if (array_key_exists($dayMonthStr, $dataDays)) {
				$graph['times'][]     = round($dataDays[$dayMonthStr]['avgTakeTime'] / 60, 2);
				$graph['completes'][] = $dataDays[$dayMonthStr]['total'];
			}else {
				$graph['times'][]     = 0;
				$graph['completes'][] = 0;
			}

			$daySeries->addDay();
			$daysBack--;
		}

		return $graph;
	}

}