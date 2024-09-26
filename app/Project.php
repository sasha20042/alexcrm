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
    'additionalExpenses',
    'photos', 'housing_photos', 'production_photos'





    ];
    protected $casts = [
        'photos' => 'array',
        'housing_photos' => 'array',
        'production_photos' => 'array', // Автоматично конвертує JSON у масив
    ];
}
