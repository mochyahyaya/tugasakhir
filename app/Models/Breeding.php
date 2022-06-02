<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeding extends Model
{
    use HasFactory;

    public $table = 'breedings';

    public $guarded = [''];

    public function pets()
    {
        return $this->belongsTo(Pet::class, 'pet_id_1');
    }

    public function cages()
    {
        return $this->belongsTo(Cage::class, 'cage_id');
    }

    public function scopeSearch($query, $val){
        return $query
        ->select('breedings.*', 'breedings.id AS id')
        ->leftJoin('pets', 'pets.id', '=', 'breedings.pet_id_1')
        ->where(function ($query) use ($val){
            $query
            ->orwhere('name', 'like', '%' .$val. '%')
            ->orWhere('pet_id_2', 'like', '%' .$val. '%');
        });
    }
}
