<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';
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

    public function scopeSearch($query, $val){
        return $query
        ->select('hotels.*', 'hotels.id AS id')
        ->leftJoin('pets', 'pets.id', '=', 'hotels.pet_id')
        ->where(function ($query) use ($val){
            $query
            ->orwhere('name', 'like', '%' .$val. '%')
            ->orwhere('start_date', 'like', '%' .$val. '%')
            ->Orwhere('end_date', 'like', '%'. $val. '%')
            ->Orwhere('status', 'like', '%' .$val. '%');
        });
    }

}               