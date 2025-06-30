<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project; // Import the Project model
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // For type hinting

class ProjectController extends Controller
{
    /**
     * Display a listing of the published projects.
     */
    public function index(): JsonResponse
    {
        $projects = Project::where('status', 'published')
                            ->select('id', 'title', 'slug', 'thumbnail_url', 'short_description')
                            ->orderBy('created_at', 'desc') // Optional: order by creation date
                            ->get();
        return response()->json($projects);
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
    public function show(Project $project): JsonResponse // Type-hint Project model for route model binding
    {
        // Check if the project is published.
        // Route model binding will automatically return 404 if no project is found by slug.
        // We also need to ensure only 'published' projects are accessible via this public endpoint.
        if ($project->status !== 'published') {
            abort(404, 'Project not found or not published.');
        }

        // For now, return all attributes.
        // Later, this can be refined with API Resources if complex transformations or conditional attributes are needed.
        // Also, related data like image gallery and files will be added here.
        return response()->json($project);
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
