<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pets';
    protected $guarded = [];

    public function typepet()
    {
        return $this->belongsTo(TypePet::class, 'type_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grooms()
    {
        return $this->belongsTo(Groom::class, 'id', 'pet_id');
    }

    public function hotels()
    {
        return $this->belongsTo(Hotel::class, 'id', 'pet_id');
    }

    public function breeds()
    {
        return $this->belongsTo(Breeding::class, 'id', 'pet_id_1');
    }

    public function scopeSearch($query, $val){
        return $query
        ->where('user_id', 1)
        ->where(function ($query) use ($val){
            $query
            ->orwhere('name', 'like', '%' .$val. '%')
            ->Orwhere('type_id', 'like', '%' .$val. '%')
            ->Orwhere('size', 'like', '%' .$val. '%')
            ->Orwhere('race', 'like', '%' .$val. '%')
            ->Orwhere('weight', 'like', '%' .$val. '%')
            ->Orwhere('colour', 'like', '%' .$val. '%');
        });
}
}