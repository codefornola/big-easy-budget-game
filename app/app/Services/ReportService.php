<?php namespace App\Services;

use App\Models\Budget;
use Illuminate\Support\Collection;

class ReportService{

	protected $budget;
	protected $format;
	protected $collection;

	public function import(Budget $budget){

		$this->budget = $budget;
		$report = new Collection([$this->getHeaderRow()]);
		foreach($this->budget->results as $result){
			foreach($result->allocations()->orderBy('organization_name', 'DESC')->get() as $org){
				$report->push($this->mapResultToRow($result, $org));
			}
		}
		$this->collection = $report;
		return $this;

	}

	public function mapResultToRow($result, $org){
		return [
				$result['user_id'],
			//$result['budget_id'],
				$result['take_time'],
			//$org['organization_id'],
				$org['organization_name'],
				$org['category'] ?: 'None',
				$org['units'],
				$org['units_min'],
				$org['units_prev'],
				$org['poll_question'] ?: null,
				$org['poll_action'] ?: null,
				$org['poll_answer'] ?: null,
		];
	}

	public function getHeaderRow(){
		return [
				'UserId',
			//'BudgetId',
				'TakeTime',
			//'OrgId',
				'OrgName',
				'OrgCategory',
				'UnitsAllocated',
				'UnitsMinimum',
				'UnitsPreviousYr',
				'PollQuestion',
				'PollAction',
				'PollAnswer'
		];
	}

	public function downloadAs($filename, $format = 'csv'){

		switch($format){
			case 'csv':
			default:
				$this->sendDownloadHeaders($filename);
				$out = fopen('php://output', 'w');
				foreach($this->collection as $line){
					fputcsv($out, $line);
				}
				fclose($out);
				break;
		}
		exit;

	}

	public function defaultReportFilename(){
		return str_slug($this->budget->name) . '-report-' . time() .'.csv';
	}

	public function sendDownloadHeaders($filename){
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header("Cache-control: private");
		header("Content-type: application/force-download");
		header("Content-transfer-encoding: binary\n");
	}

}