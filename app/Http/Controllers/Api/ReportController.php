<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = Report::with(['sensor', 'sumber_emisi', 'perusahaan'])->latest()->paginate(15);
        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'No reports found',
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'List of reports',
                'data' => ReportResource::collection($report)
            ], 200);
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = Report::with(['sensor', 'sumber_emisi', 'perusahaan'])->findOrFail($id);
        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Report not found',
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Report details',
                'data' => ReportResource::collection($report)
            ], 200);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
