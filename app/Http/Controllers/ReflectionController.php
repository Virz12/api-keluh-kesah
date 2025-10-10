<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReflectionRequest;
use App\Http\Resources\ReflectionResource;
use App\Models\Reflection;
use Illuminate\Support\Facades\Auth;

class ReflectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reflection = Reflection::with('user')->where('user_id', Auth::user()->id)->get();

        return ReflectionResource::collection($reflection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReflectionRequest $request)
    {
        $validated = $request->validated();

        $reflection = Reflection::create([
            'user_id' => Auth::user()->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Refleksi berhasil dibuat',
            'data' => new ReflectionResource($reflection),
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reflection = Reflection::find($id);

        if (! $reflection) {
            return response()->json(['message' => 'Refleksi tidak ditemukan'], 404);
        }

        if ($reflection->user_id != Auth::user()->id) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk mengubah refleksi ini',
                'error' => 'Unauthorized',
            ], 403);
        }

        $reflection->delete();

        return response()->json(['message' => 'Refleksi berhasil dihapus'], 200);
    }
}
