<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // No sample videos seeded by default. Add real Peyer Memorial Congregation
        // videos here, or upload them through the admin dashboard.
        $videos = [];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
