<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
 
    protected $fillable = [
        'country',
        'company',
        'city',
        'vacancy',
        'job',
        'status',
        'projectName',
    'factorySpecialization',
    'workLocation',
    'jobTitle',
    'genderAgeRestrictions',
    'shortDetails',
    'productionChanges',
    'workingHours',
    'salary',
    'accommodationConditions',
    'mealConditions',
    'transportation',
    'additionalExpenses'





    ];
}
