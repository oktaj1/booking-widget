<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Hotel $hotel)
    {
        return $hotel->rooms;
    }
    
}
