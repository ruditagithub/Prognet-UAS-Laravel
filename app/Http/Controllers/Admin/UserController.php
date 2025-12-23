<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $id . ',id',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:100|unique:users,email,' . $id . ',id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Error updating user. Please try again.');
        }

        $user = User::findOrFail($id);
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.index')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting user. Please try again.');
        }
    }
}
