<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitorings';

    protected $guarded = [];


    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function cages()
    {
        return $this->hasMany(Cage::class);
    }
}
