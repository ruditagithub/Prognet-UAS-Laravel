<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|regex:/^RM[0-9]+$/|unique:rooms,id',
            'room_type' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'available_rooms' => 'required|integer|min:0',
        ], [
            'id.regex' => 'Format harus RM diikuti angka, contohnya RM10',
            'id.unique' => 'Room ID already exists. Please use a unique ID.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Error adding room. Please try again.');
        }

        Room::create([
            'id' => $request->id,
            'room_type' => $request->room_type,
            'price' => $request->price,
            'available_rooms' => $request->available_rooms,
        ]);

        return redirect()->route('admin.index')->with('success', 'Room added successfully!');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'room_type' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'available_rooms' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Error updating room. Please try again.');
        }

        $room = Room::findOrFail($id);
        $room->update([
            'room_type' => $request->room_type,
            'price' => $request->price,
            'available_rooms' => $request->available_rooms,
        ]);

        return redirect()->route('admin.index')->with('success', 'Room updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $room = Room::findOrFail($id);
            $room->delete();
            return redirect()->route('admin.index')->with('success', 'Room deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting room. Please try again.');
        }
    }
}
