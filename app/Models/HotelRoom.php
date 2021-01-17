<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'description',
        'price'
    ];

    protected $visible = [
        'room_id',
        'description',
        'price',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];
}
