<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarEvent;

class DashboardController extends Controller
{
    public function index()
    {
        $events = CalendarEvent::all();

        return view('dashboard', compact('events'));
    }
}
