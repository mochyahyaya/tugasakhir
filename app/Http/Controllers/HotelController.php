<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function create()
    {
        $users = User::all();

        return view('hotels.create', compact('users'));
    }

    public function store(Request $reqeuset)
    {
        //
    }
}
