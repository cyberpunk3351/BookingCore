<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Requests\StoreHuntingBookingRequest;
use App\Models\HuntingBooking;
use Illuminate\Http\JsonResponse;

class HuntingBookingController extends Controller
{
    public function store(StoreHuntingBookingRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Check guide availability
        $exists = HuntingBooking::where('guide_id', $data['guide_id'])
            ->where('date', $data['date'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Guide already has a booking on this date.'
            ], 422);
        }

        if ($data['participants_count'] > 10) {
            return response()->json([
                'message' => 'Maximum participants per tour is 10.'
            ], 400);
        }

        $booking = HuntingBooking::create($data);

        return response()->json([
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }
}
