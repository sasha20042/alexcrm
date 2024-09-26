<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
 
    protected $fillable = [
        'date',
        'number',
        'count',
        'location',
        'code',
        'manager',
        'status',
        'comment',
        'note'
        
    ];
}
