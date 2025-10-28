<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintRequest;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of all resource.
     */
    public function all()
    {
        $complaints = Complaint::with('user')->get();

        return ComplaintResource::collection($complaints);
    }

    /**
     * Display a listing of the resource for specific user.
     */
    public function index()
    {
        $complaints = Complaint::with('user')->where('user_id', Auth::user()->id)->get();

        return ComplaintResource::collection($complaints);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintRequest $request)
    {
        $validated = $request->validated();

        $complaint = Complaint::create([
            'user_id' => Auth::user()->id,
            'content' => $validated['content'],
            'can_comment' => $validated['can_comment'],
        ]);

        return response()->json([
            'message' => 'Keluhan berhasil dibuat',
            'data' => new ComplaintResource($complaint),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $complaint = Complaint::with('comments.user')->findOrFail($id);

        return new ComplaintResource($complaint);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintRequest $request, string $id)
    {
        $validated = $request->validated();

        $complaint = Complaint::find($id);

        if (! $complaint) {
            return response()->json(['message' => 'Keluhan tidak ditemukan'], 404);
        }

        if ($complaint->user_id != Auth::user()->id) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk mengubah keluhan ini',
                'error' => 'Unauthorized',
            ], 403);
        }

        $complaint->update($validated);

        return response()->json([
            'message' => 'Keluhan berhasil diperbarui',
            'data' => new ComplaintResource($complaint),
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $complaint = Complaint::find($id);

        if (! $complaint) {
            return response()->json(['message' => 'Keluhan tidak ditemukan'], 404);
        }

        if ($complaint->user_id != Auth::user()->id) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk mengubah keluhan ini',
                'error' => 'Unauthorized',
            ], 403);
        }

        $complaint->delete();

        return response()->json(['message' => 'Keluhan berhasil dihapus'], 200);
    }
}
