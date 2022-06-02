<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePet extends Model
{
    use HasFactory;
    protected $table = 'type_pets';

    protected $guarded = [];

    public function hotels()
    {
        return $this->hasMany(Cage::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
