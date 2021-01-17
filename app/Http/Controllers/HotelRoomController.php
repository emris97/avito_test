<?php

namespace App\Http\Controllers;

use App\Models\HotelRoom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelRoomController extends Controller
{
    private const DEFAULT_SORT_ORDER = 'asc';
    private const DEFAULT_SORT_FIELD = 'room_id';

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getRooms(Request $request): JsonResponse
    {
        $sortOrder = $request->sort_order ? $request->sort_order : self::DEFAULT_SORT_ORDER;
        $field = $request->sort_field ? $request->sort_filed : self::DEFAULT_SORT_FIELD;

        $rooms = HotelRoom::orderBy($field, $sortOrder)->get();;

        return $this->sendSuccessResponse(['rooms' => $rooms], 'Room successfully loaded', 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createRoom(Request $request): JsonResponse
    {
        $hotelRoom = HotelRoom::create(
            $request->only(['description', 'price']),
        );

        $hotelRoomId = $hotelRoom->room_id;

        $hotelRoom->save();

        return $this->sendSuccessResponse([
            'room_id' => $hotelRoomId
        ], 'Room successfully created');
    }


    /**
     * @param $roomId
     * @return JsonResponse
     */
    public function deleteRoom($roomId): JsonResponse
    {
        $room = HotelRoom::where('room_id', $roomId)->first();

        if (!$room) {
            return $this->sendErrorResponse('Not Found', "Room with id {$roomId} not found", 404);
        }

        $room->delete();

        return $this->sendSuccessResponse('', '', 204);
    }
}
