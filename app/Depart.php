<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
 
    protected $fillable = [
        'title',
        'city',
        'date',
        'description'
        
    ];
}
