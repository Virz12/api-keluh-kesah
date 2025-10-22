<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function changePassword(ChangePasswordRequest $request) {
        $validated = $request->validated();

        $user = Auth::user();

        // check if the current password is correct
        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'message' => 'Password lama salah'
            ], 400);
        }

        //update the password
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return response()->json([
            'message' => 'Password berhasil diubah'
        ], 200);
    }

    public function changeName (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);

        $user = Auth::user();

        $user->name = $validated['name'];
        $user->save();

        return response()->json([
            'message' => 'Nama berhasil diubah'
        ], 200);
    }
}
