<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::whereHas('user', function ($query) {
            $query->whereId(request()->input('user_id', 0));
        })->pluck('name', 'id');

        return response()->json($pets);
    }
}
