<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 
    protected $fillable = [
        'title',
        'price',
        'product_code',
        'description',
        'manager',
        'age',
        'sex',
        'location',
        'citizenship',
        'blacklist'
    ];
}
