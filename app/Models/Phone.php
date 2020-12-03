<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'uuid',
        'scn',
        'status',
        'issue',
        'name',
        'phone',
        'resolved',
        'opened',
        'call_count',
        'closed',
        'comment',
        'active',
    ];
}
