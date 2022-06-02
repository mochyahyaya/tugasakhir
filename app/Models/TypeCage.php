<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCage extends Model
{
    use HasFactory;

    protected $table = 'type_cages';

    protected $guarded = [];

    public function hotels()
    {
        return $this->hasMany(Cage::class);
    }
}
