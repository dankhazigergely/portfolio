<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project; // Import Project model
use Illuminate\Support\Str; // Import Str facade for slug generation

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'My First Awesome Project',
            'slug' => Str::slug('My First Awesome Project'),
            'thumbnail_url' => 'https://via.placeholder.com/300x200.png?text=Project+Thumbnail+1',
            'hero_image_url' => 'https://via.placeholder.com/1200x400.png?text=Project+Hero+1',
            'short_description' => 'This is a short and catchy description of my first awesome project. It solves a real world problem!',
            'long_description_markdown' => "## Project Overview\n\nThis project aims to do amazing things. It's built with cutting-edge technology and a lot of passion.\n\n### Features\n\n*   Feature A\n*   Feature B\n*   Feature C\n\n### Technology Stack\n\n*   Laravel\n*   React\n*   Magic",
            'project_url' => 'https://example.com/my-first-project',
            'status' => 'published',
        ]);

        Project::create([
            'title' => 'The Secret Second Project',
            'slug' => Str::slug('The Secret Second Project'),
            'thumbnail_url' => 'https://via.placeholder.com/300x200.png?text=Project+Thumbnail+2',
            'hero_image_url' => 'https://via.placeholder.com/1200x400.png?text=Project+Hero+2',
            'short_description' => 'A sneak peek into another exciting venture, still under wraps.',
            'long_description_markdown' => "## Top Secret!\n\nDetails about this project are not yet public. Stay tuned!",
            'project_url' => 'https://example.com/secret-project',
            'status' => 'draft', // This one is a draft
        ]);

        Project::create([
            'title' => 'Community Initiative Platform',
            'slug' => Str::slug('Community Initiative Platform'),
            'thumbnail_url' => 'https://via.placeholder.com/300x200.png?text=Project+Thumbnail+3',
            'hero_image_url' => 'https://via.placeholder.com/1200x400.png?text=Project+Hero+3',
            'short_description' => 'A platform to connect volunteers with local community projects and initiatives.',
            'long_description_markdown' => "## Empowering Communities\n\nOur platform facilitates the organization and discovery of local volunteer opportunities. \n\n### Key Goals\n\n*   Easy project posting for organizers.\n*   Simple search and sign-up for volunteers.\n*   Tracking impact and volunteer hours.",
            'project_url' => 'https://example.com/community-platform',
            'status' => 'published',
        ]);
    }
}
