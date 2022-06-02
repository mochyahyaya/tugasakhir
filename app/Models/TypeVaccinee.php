<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVaccinee extends Model
{
    use HasFactory;

    protected $table = 'vaccinee';

    protected $guarded = [''];
}