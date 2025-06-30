<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'thumbnail_url' => $this->faker->imageUrl(),
            'short_description' => $this->faker->paragraph,
            'long_description_markdown' => $this->faker->paragraphs(3, true), // Corrected column name
            'hero_image_url' => $this->faker->imageUrl(), // Added hero_image_url
            'project_url' => $this->faker->url(), // Added project_url
            'status' => $this->faker->randomElement(['draft', 'published']),
            // Removed image_gallery, files, meta_title, meta_description, meta_keywords
        ];
    }

    /**
     * Indicate that the project is published.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
            ];
        });
    }

    /**
     * Indicate that the project is a draft.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'draft',
            ];
        });
    }
}
