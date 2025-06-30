<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectApiTest extends TestCase
{
    use RefreshDatabase; // Resets the database for each test

    /**
     * Test the /api/projects endpoint.
     *
     * @return void
     */
    public function test_get_projects_endpoint(): void
    {
        // Create some projects (published and unpublished)
        Project::factory()->create(['status' => 'published', 'title' => 'Published Project 1']);
        Project::factory()->create(['status' => 'published', 'title' => 'Published Project 2']);
        Project::factory()->create(['status' => 'draft', 'title' => 'Draft Project']);

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
            ->assertJsonCount(2) // Expecting only 2 published projects
            ->assertJsonStructure([
                '*' => [ // '*' means each item in the array
                    'id',
                    'title',
                    'slug',
                    'thumbnail_url',
                    'short_description',
                ]
            ]);

        // Optionally, assert that specific data is NOT present if needed,
        // e.g., ensure the draft project is not returned.
        $response->assertJsonMissing(['title' => 'Draft Project']);
    }

    /**
     * Test the /api/projects/{slug} endpoint.
     *
     * @return void
     */
    public function test_get_single_project_endpoint(): void
    {
        // Create a published project
        $publishedProject = Project::factory()->published()->create(['title' => 'My Awesome Project']);

        // Create a draft project
        $draftProject = Project::factory()->draft()->create(['title' => 'My Secret Project']);

        // Test fetching the published project
        $responsePublished = $this->getJson('/api/projects/' . $publishedProject->slug);
        $responsePublished->assertStatus(200)
            ->assertJson([ // Check for specific fields including the corrected one
                'id' => $publishedProject->id,
                'title' => $publishedProject->title,
                'slug' => $publishedProject->slug,
                'thumbnail_url' => $publishedProject->thumbnail_url,
                'hero_image_url' => $publishedProject->hero_image_url, // Assert this
                'short_description' => $publishedProject->short_description,
                'long_description_markdown' => $publishedProject->long_description_markdown,
                'project_url' => $publishedProject->project_url, // Assert this
                'status' => 'published',
            ])
            ->assertJsonStructure([ // Verify the overall structure for a single project based on migration
                'id',
                'title',
                'slug',
                'thumbnail_url',
                'hero_image_url',
                'short_description',
                'long_description_markdown',
                'project_url',
                'status',
                'created_at',
                'updated_at',
                // Removed image_gallery, files, and meta fields as they are not in the migration
            ]);

        // Test fetching the draft project (should return 404)
        $responseDraft = $this->getJson('/api/projects/' . $draftProject->slug);
        $responseDraft->assertStatus(404);

        // Test fetching a non-existent project (should return 404)
        $responseNotFound = $this->getJson('/api/projects/non-existent-slug');
        $responseNotFound->assertStatus(404);
    }
}
