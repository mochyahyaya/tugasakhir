<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery_photos';
    
    protected $guarded = [];

    public function pets()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}