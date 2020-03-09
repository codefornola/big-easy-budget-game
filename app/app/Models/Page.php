<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Page extends Model {

    protected $guarded    = [];
    protected $dates      = ['created_at', 'updated_at', 'deleted_at', 'opened_at', 'closed_at'];

    protected $casts = [
        'is_active' => 'bool',
        'order'     => 'int'
    ];



}
