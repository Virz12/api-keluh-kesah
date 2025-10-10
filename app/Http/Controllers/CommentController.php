<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('complaint')->where('user_id', Auth::user()->id)->get();

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $validated = $request->validated();

        $complaint = Complaint::find($validated['complaint_id']);

        if ($complaint->can_comment == false) {
            return response()->json([
                'message' => 'Komentar tidak diizinkan untuk keluhan ini',
            ], 403);
        }

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'complaint_id' => $complaint->id,
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Komentar berhasil dibuat',
            'data' => new CommentResource($comment),
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);

        if (! $comment) {
            return response()->json([
                'message' => 'Komentar tidak ditemukan',
            ], 404);
        }

        if ($comment->user_id !== Auth::user()->id) {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus komentar ini',
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Komentar berhasil dihapus',
        ], 200);
    }
}
