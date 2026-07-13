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
        $videos = [
            [
                'title' => '60th Anniversary Celebration',
                'description' => 'Join us as we celebrate 60 years of faith, fellowship, and service at PCG Monninger Congregation.',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=3GotPlhAT3o',
                'thumbnail' => null,
                'category' => 'Special Events',
                'featured' => true,
                'published' => true,
                'publish_date' => '2024-01-01',
            ],
            [
                'title' => 'Cultural Sunday: Akan and Guan Tribes Heritage',
                'description' => 'Experience the rich cultural heritage of the Akan and Guan tribes as we celebrate our diversity in Christ.',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=I_q852Mh7Sc',
                'thumbnail' => null,
                'category' => 'Cultural Events',
                'featured' => true,
                'published' => true,
                'publish_date' => '2024-01-01',
            ],
            [
                'title' => 'From Plate to Heritage: Dangme Foods',
                'description' => 'Discover the culinary traditions of the Dangme people and how food connects us to our heritage.',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=4NtVy05HD_g',
                'thumbnail' => null,
                'category' => 'Cultural Events',
                'featured' => false,
                'published' => true,
                'publish_date' => '2024-01-01',
            ],
            [
                'title' => 'Unlocking Ewe Culture Through Food',
                'description' => 'Explore the vibrant Ewe culture through its traditional foods and culinary practices.',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=qsg6vwHZcDE',
                'thumbnail' => null,
                'category' => 'Cultural Events',
                'featured' => false,
                'published' => true,
                'publish_date' => '2024-01-01',
            ],
            [
                'title' => '90% Score for COVID-19 Protocol Adherence',
                'description' => 'Our congregation\'s commitment to health and safety during the pandemic, achieving a 90% compliance score.',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=bbT06TR1tlA',
                'thumbnail' => null,
                'category' => 'Health & Safety',
                'featured' => false,
                'published' => true,
                'publish_date' => '2020-01-01',
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
