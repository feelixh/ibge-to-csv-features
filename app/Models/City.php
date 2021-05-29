<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'idh',
        'name',
        'urban',
        'rural',
        'youngs',
        'adults',
        'catholic',
        'isolated',
        'elderlies',
        'spiritist',
        'population',
        'evangelical',
        'covid_deaths',
        'covid_confirmed',
        'without_religion',
    ];
}
