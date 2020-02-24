<?php namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Http\Requests\StoreResultRequest;
use App\Models\Budget;
use App\Models\Result;
use App\Models\Organization;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{

    public function gameList()
    {

        $budgetEn = Budget::find('56d87b9878b85e4c3a8b4568');
        $budgetEs = Budget::find('5783fbce78b85eb8168b4752');

        return view('game.list', compact('budgetEn', 'budgetEs'));
    }

    public function intro(Budget $budget)
    {
        if (!$budget->is_active) {
            return Redirect::route('home.index')->withErrors(['That budget game has ended.']);
        }

        return view('game.intro', compact('budget'));
    }

    public function play(Budget $budget)
    {
//        $budget     = Budget::orderby('is_active', 'desc')->orderby('created_at', 'desc')->first();
        $start_time = Carbon::now()->getTimestamp();

        return view('game.play', compact('budget', 'start_time'));
    }

    public function save(StoreResultRequest $request, Budget $budget)
    {

        if ($request->isMethod('POST')) {

            $resultData              = $request->only(['budget_id', 'start_time']);
            $resultData['user_id']   = Auth::user()->id;
            $resultData['end_time']  = Carbon::now();
            $resultData['take_time'] = $resultData['start_time']->diffInSeconds($resultData['end_time']);

            $result         = Result::create($resultData);
            $totalAllocated = 0;
            $allocations    = $request->only(['org']);

//			$budget = Budget::find($result->budget_id);

            foreach ($allocations['org'] as $orgId => $data) {
                $org      = Organization::with('category')->find($orgId);
                $itemData = [
                    'organization_id'     => $orgId,
                    'organization_name'   => $org->name,
                    'category'            => (count($org->category) ? $org->category->name : null),
                    'units'               => $data['units'],
                    'units_min'           => $org->units_min,
                    'units_prev'          => $org->units_previous_period,
                    'units_other_funding' => $org->units_other_funding,
                ];
                if (count($org->poll) && !empty($org->poll->question)) {
                    $itemData['poll_question'] = $org->poll->question;
                    // If a poll action was taken
                    if (!empty($data['poll_action'])) {
                        // make note
                        $itemData['poll_action'] = $data['poll_action'];
                        // and save answer
                        if (!empty($data['poll_answer'])) {
                            $itemData['poll_answer'] = $data['poll_answer'];
                        }
                        // otherwise question was never seen
                    }else {
                        $itemData['poll_action'] = 'none';
                    }
                }
                $result->allocations()->create($itemData);
                $totalAllocated += $data['units'];
            }
            $result->update([
                'units_label'     => $budget->units_label,
                'units_value'     => $budget->units_value,
                'units_total'     => $budget->units_total,
                'units_allocated' => $totalAllocated,
            ]);

        }

        return view('game.thanks', compact('budget', 'result'));
    }

}