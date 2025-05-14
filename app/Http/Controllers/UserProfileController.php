<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\CalendarEvent;


class UserProfileController extends Controller
{
    public function index()
    {
        $users = UserProfile::all();
        return view('user_profiles.index', compact('users'));
    }

    public function create()
    {
        return view('user_profiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prefix' => 'required|string|max:10',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:ชาย,หญิง',
            'position' => 'required|string|max:255',
            'user_group' => 'required|string|max:255',
            'registered_at' => 'required|date',
            'location' => 'required|string',
            'purpose'=>'required|string',
            
        ]);

        UserProfile::create($request->all());

        return redirect()->route('user-profiles.index')->with('success', 'เพิ่มผู้ใช้เรียบร้อยแล้ว');
    }

    public function edit($id)
{
    $userProfile = UserProfile::findOrFail($id); // ดึงข้อมูลจาก DB
    return view('user_profiles.edit', compact('userProfile'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'prefix' => 'required|string|max:10',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:ชาย,หญิง',
            'position' => 'required|string|max:255',
            'user_group' => 'required|string|max:255',
            'registered_at' => 'required|date',

        ]);

        $user = UserProfile::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('user-profiles.index')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $user = UserProfile::findOrFail($id);
        $user->delete();

        return redirect()->route('user-profiles.index')->with('success', 'ลบผู้ใช้เรียบร้อยแล้ว');
    }

    public function confirm($id)
{
    $user = UserProfile::findOrFail($id);

    // เช็คว่าเคยจองหรือยัง
    $exists = CalendarEvent::where('first_name', $user->first_name)
        ->where('last_name', $user->last_name)
        ->where('registered_at', $user->registered_at)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'การจองนี้ถูกยืนยันแล้ว');
    }

    // สร้างข้อมูลใหม่ในตาราง calendar_events
    CalendarEvent::create([
        'prefix' => $user->prefix,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'gender' => $user->gender,
        'position' => $user->position,
        'user_group' => $user->user_group,
        'registered_at' => $user->registered_at,
        'location' => $user->location,
        'purpose' => $user->purpose,
        'created_at' => now(),
        'updated_at' => now(),
        'passenger_count' => 1,
        'is_confirmed' => true,
    ]);

    return redirect()->route('calendar.index')->with('success', 'ยืนยันการจองเรียบร้อยแล้ว');
}




   
}
