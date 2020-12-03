<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'uuid',
        'scn',
        'status',
        'issue',
        'name',
        'email',
        'resolved',
        'opened',
        'mail_count',
        'closed',
        'comment',
        'active',
    ];
}
