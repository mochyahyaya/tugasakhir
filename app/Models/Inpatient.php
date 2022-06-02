<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inpatient extends Model
{
    use HasFactory;
    protected $table = 'inpatients';
    protected $guarded = [];

    public function cages()
    {
        return $this->belongsTo(Cage::class, 'cage_id');
    }

    public function monitoring()
    {
        return $this->belongsTo(Monitoring::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pets()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}
