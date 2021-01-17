<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelRoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'rooms',
], function ($router) {
    Route::get('/get_rooms', [HotelRoomController::class, 'getRooms']);
    Route::post('/create_room', [HotelRoomController::class, 'createRoom']);
    Route::delete('/delete_room/{room_id}', [HotelRoomController::class, 'deleteRoom']);
});

Route::group([
    'prefix' => 'bookings',
], function ($router) {
    Route::get('/get_bookings/{room_id}', [BookingController::class, 'getRoomBookings']);
    Route::post('/create_booking', [BookingController::class, 'createBooking']);
    Route::delete('/delete_booking/{booking_id}', [BookingController::class, 'deleteBooking']);
});




