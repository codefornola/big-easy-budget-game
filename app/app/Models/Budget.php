<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Budget extends Model {

//    protected $connection = 'mongodb';
    protected $guarded    = [];
    protected $dates      = ['created_at', 'updated_at', 'deleted_at', 'opened_at', 'closed_at'];

    protected $casts = [
        'units_value'       => 'int',
        'units_total'       => 'int',
        'is_active'         => 'bool',
        'require_spend_all' => 'bool'
    ];

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function organizations()
    {
        return $this->hasMany('App\Models\Organization');
    }

    public function uncategorizedOrgs()
    {
        return $this->organizations()->where('category_id', '=', null)->get();
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function users()
    {
        return $this->hasManyThrough('App\Models\User', 'App\Models\Result');
    }

    public function status()
    {
        // If not opened yet
        if (empty($this->opened_at)) {
            return 'pending';
        }

        // Has been opened
        // Not yet closed
        if (empty($this->closed_at)) {
            return $this->is_active ? 'open' : 'paused';
        }else {
            return 'closed';
        }
    }

    public function statusClass()
    {
        switch ($this->status()) {
            case 'pending':
                return 'warning';
            case 'open':
                return 'success';
            case 'paused':
                return 'info';
            case 'closed':
                return 'danger';
        }
    }


    public function getAvgTakeTime()
    {

        // Average units per organization
        $budget = $this;
        $data   = Result::raw(function ($collection) use ($budget){
            return $collection->aggregate(
                ['$match' => ['budget_id' => $budget->id]],
                [
                    '$group' => [
                        '_id'         => null,
                        'avgTakeTime' => ['$avg' => '$take_time']
                    ]
                ]
            );
        });

        return !empty($data)
            ? $this->secondsToTime($data['result'][0]['avgTakeTime']) // converts seconds to time
            : null;

    }

    public static function secondsToTime($seconds)
    {
        $h    = (int)($seconds / 3600);
        $m    = (int)(($seconds - $h * 3600) / 60);
        $s    = (int)($seconds - $h * 3600 - $m * 60);
        $time = "{$s}s";
        if ($m) {
            $time = "{$m}min $time";
        }
        if ($h) {
            $time = "{$h}hr $time";
        }

        return $time;
    }

    public function getAggregateData()
    {

        return [
            'summaryActivity'       => self::aggregateSummaryActivity($this),
            'avgUnitsPerOrg'        => self::aggregateAvgUnitsPerOrg($this),
            'totalUnitsPerCategory' => self::aggregateTotalUnitsPerCategory($this),
            'latestActivity'        => self::aggregateLatestActivity($this),
            //'overallActivity'       => self::aggregateOverallActivity($this),
        ];

    }

    public static function aggregateAvgUnitsPerOrg($budget)
    {

        // Average units per organization
        $data = Result::raw(function ($collection) use ($budget){
            return $collection->aggregate(
                ['$match' => ['budget_id' => $budget->id]],
                ['$unwind' => '$allocations'],
                [
                    '$group' => [
                        '_id'      => '$allocations.organization_id',
                        'avgUnits' => ['$avg' => '$allocations.units'],
                        'orgName'  => ['$first' => '$allocations.organization_name']
                    ]
                ],
                [
                    '$project' => [
                        '_id'      => 1,
                        'avgUnits' => 1,
                        'orgName'  => 1,
                        'pctUnits' => ['$divide' => ['$avgUnits', $budget->units_total]]
                    ]
                ],
                [
                    '$sort' => [
                        'avgUnits' => -1
                    ]
                ]
            );
        });

        return !empty($data)
            ? $data['result']
            : null;
    }

    public static function aggregateTotalUnitsPerCategory($budget)
    {

        // Total units per category
        $count = $budget->results->count();
        $data  = Result::raw(function ($collection) use ($budget, $count){
            return $collection->aggregate(
                ['$match' => ['budget_id' => $budget->id]],
                ['$unwind' => '$allocations'],
                [
                    '$group' => [
                        '_id'        => [
                            '_id' => '$allocations.category',
                        ],
                        'totalUnits' => ['$sum' => '$allocations.units']
                    ]
                ],
                [
                    '$project' => [
                        '_id'        => 1,
                        'name'       => 1,
                        'count'      => 1,
                        'totalUnits' => 1,
                        'avgUnits'   => ['$divide' => ['$totalUnits', $count]],
                    ]
                ]
            );
        });

        return !empty($data)
            ? $data['result']
            : null;

    }

    public static function aggregateLatestActivity($budget, $daysAgo = 14)
    {

        // Latest activity
        $data = Result::raw(function ($collection) use ($budget, $daysAgo){

            $today      = new \MongoDate();
            $recentDays = new \MongoDate(strtotime("$daysAgo days ago"));

            return $collection->aggregate(
                [
                    '$match' => [
                        'budget_id'  => $budget->id,
                        'created_at' => ['$gt' => $recentDays, '$lte' => $today]
                    ]
                ],
                [
                    '$group' => [
                        '_id'         => [
                            'month' => ['$month' => '$created_at'],
                            'day'   => ['$dayOfMonth' => '$created_at'],
                            'year'  => ['$year' => '$created_at']
                        ],
                        'avgTakeTime' => ['$avg' => '$take_time'],
                        'total'       => ['$sum' => 1]
                    ]
                ],
                [
                    '$sort' => [
                        '_id.year'  => 1,
                        '_id.month' => 1,
                        '_id.day'   => 1
                    ]
                ]
            );
        });

        return !empty($data)
            ? $data['result']
            : null;

    }

    public static function aggregateSummaryActivity($budget)
    {

        // Overall activity
        $data = Result::raw(function ($collection) use ($budget){

            return $collection->aggregate(
                [
                    '$match' => [
                        'budget_id' => $budget->id
                    ]
                ],
                [
                    '$group' => [
                        '_id'         => null,
                        'avgTakeTime' => ['$avg' => '$take_time'],
                        'total'       => ['$sum' => 1]
                    ]
                ]
            );
        });

        return (!empty($data) && is_array($data['result']) && !empty($data['result']))
            ? $data['result'][0]
            : null;

    }

    public static function aggregateOverallActivity($budget)
    {

        // Overall activity
        $data = Result::raw(function ($collection) use ($budget){

            $opened = $budget->opened_at;
            $closed   = isset($budget->closed_at) ? $budget->closed_at : new \MongoDate();

            return $collection->aggregate(
                [
                    '$match' => [
                        'budget_id'  => $budget->id,
                        'created_at' => ['$gt' => $opened, '$lte' => $closed]
                    ]
                ],
                [
                    '$group' => [
                        '_id'         => [
                            'month' => ['$month' => '$created_at'],
                            'day'   => ['$dayOfMonth' => '$created_at'],
                            'year'  => ['$year' => '$created_at']
                        ],
                        'avgTakeTime' => ['$avg' => '$take_time'],
                        'total'       => ['$sum' => 1]
                    ]
                ],
                [
                    '$sort' => [
                        '_id.year'  => 1,
                        '_id.month' => 1,
                        '_id.day'   => 1
                    ]
                ]
            );
        });

        return (!empty($data) && is_array($data['result']) && !empty($data['result']))
            ? $data['result'][0]
            : null;

    }

}
