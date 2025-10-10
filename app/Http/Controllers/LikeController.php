<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Like a complaint by logged user
     */
    public function like(string $id)
    {
        $user_id = Auth::user()->id;
        $complaint = Complaint::where('id', $id)->first();
        $existing_like = $complaint->likes()->where('user_id', $user_id)->first();

        if ($existing_like) {
            $complaint->likes()->where('user_id', $user_id)->delete();
            $complaint->decrement('likes_count');

            return response()->json([
                'message' => 'Keluhan berhasil tidak disukai',
            ], 200);
        }

        $complaint->likes()->create([
            'user_id' => $user_id,
            'complaint_id' => $complaint->id,
        ]);
        $complaint->increment('likes_count');

        return response()->json([
            'message' => 'Keluhan berhasil disukai',
        ], 200);
    }
}
