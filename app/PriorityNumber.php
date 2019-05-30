<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriorityNumber extends Model
{
    protected $fillable = [
        'priority_number',
        'type',
        'category',
    ];
}
