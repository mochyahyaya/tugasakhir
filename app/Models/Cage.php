<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{
    use HasFactory;

    protected $table = 'cages';

    protected $guarded = [];

    public function typecages()
    {
        return $this->belongsTo(TypeCage::class, 'type_cage_id');
    }

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function scopeSearch($query, $val){
        return $query
        ->where('type_cage_id', 'like', '%' .$val. '%')
        ->Orwhere('number', 'like', '%' .$val. '%')
        ->Orwhere('count', 'like', '%' .$val. '%');
    }
}
