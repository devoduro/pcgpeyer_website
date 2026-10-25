<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // No sample posts seeded by default. Add real Peyer Memorial Congregation
        // news items here, or create them through the admin dashboard.
        $posts = [];

        foreach ($posts as $postData) {
            // Check if post already exists
            $exists = BlogPost::where('slug', $postData['slug'])->exists();
            
            if (!$exists) {
                BlogPost::create($postData);
                $this->command->info('✓ Created blog post: ' . $postData['title']);
            } else {
                $this->command->info('⊙ Blog post already exists: ' . $postData['title']);
            }
        }

        $this->command->info('Blog posts seeding completed!');
    }
}
