<?php

// app/Models/CalendarEvent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    // เพิ่ม title ใน fillable
    protected $fillable = [
        'prefix',
        'first_name',
        'last_name',
        'gender',
        'position',
        'user_group',
        'registered_at',
        'location',
        'passenger_count',
        'purpose',
    ];
}

