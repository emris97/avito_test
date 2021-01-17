<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @param $room_id
     * @return JsonResponse
     */
    public function getRoomBookings($room_id): JsonResponse
    {
        return $this->sendSuccessResponse(Booking::where('room_id', $room_id)->orderBy('date_start', 'asc')->get(), 'Booking loaded successfully', 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createBooking(Request $request): JsonResponse
    {
        $booking = Booking::create($request->only('room_id', 'date_start', 'date_end'));

        $bookingId = $booking->booking_id;

        return $this->sendSuccessResponse(['booking_id' => $bookingId], 'Booking created successfully', 200);
    }

    /**
     * @param $bookingId
     * @return JsonResponse
     */
    public function deleteBooking($bookingId): JsonResponse
    {
        $booking = Booking::where('booking_id', $bookingId)->first();

        if (!$booking) {
            return $this->sendErrorResponse('Not Found', "Booking with id {$bookingId} not found", 404);
        }

        $booking->delete();

        return $this->sendSuccessResponse('', '', 204);
    }
}
