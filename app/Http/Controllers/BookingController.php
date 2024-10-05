<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
{
    // Validate input
    $data = $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'check_in_date' => 'required|date',
        'check_out_date' => 'required|date|after:check_in_date',
    ]);

    // Create booking
    $booking = Booking::create([
        'room_id' => $data['room_id'],
        'user_id' => auth()->id(),
        'check_in_date' => $data['check_in_date'],
        'check_out_date' => $data['check_out_date'],
        'total_amount' => $this->calculateTotal($data['room_id'], $data['check_in_date'], $data['check_out_date']),
    ]);

    return response()->json($booking, 201);
}

protected function calculateTotal($room_id, $check_in, $check_out)
{
    $room = Room::find($room_id);
    $days = Carbon::parse($check_out)->diffInDays(Carbon::parse($check_in));
    return $days * $room->price_per_night;
}

}
