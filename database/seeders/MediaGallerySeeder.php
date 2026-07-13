<?php

namespace Database\Seeders;

use App\Models\MediaGallery;
use Illuminate\Database\Seeder;

class MediaGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mediaItems = [
            // Photos
            [
                'title' => 'Sunday Worship Service',
                'description' => 'Our vibrant congregation gathered for Sunday worship',
                'type' => 'photo',
                'file_path' => 'images/gallery/worship-service-1.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/worship-service-1.jpg',
                'category' => 'Worship Services',
                'event_date' => '2025-11-10',
                'order' => 1,
                'featured' => true,
            ],
            [
                'title' => 'YAF Outreach Program',
                'description' => 'Young Adults Fellowship donating to VRA Presby School',
                'type' => 'photo',
                'file_path' => 'images/gallery/yaf-outreach.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/yaf-outreach.jpg',
                'category' => 'Community Outreach',
                'event_date' => '2025-05-26',
                'order' => 2,
                'featured' => true,
            ],
            [
                'title' => 'Choir Performance',
                'description' => 'Our talented choir leading worship in song',
                'type' => 'photo',
                'file_path' => 'images/gallery/choir-performance.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/choir-performance.jpg',
                'category' => 'Music Ministry',
                'event_date' => '2025-10-15',
                'order' => 3,
                'featured' => false,
            ],
            [
                'title' => 'Children\'s Sunday School',
                'description' => 'Children learning about God\'s love',
                'type' => 'photo',
                'file_path' => 'images/gallery/children-sunday-school.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/children-sunday-school.jpg',
                'category' => 'Children Ministry',
                'event_date' => '2025-09-20',
                'order' => 4,
                'featured' => false,
            ],
            [
                'title' => 'Ecumenical Visit',
                'description' => 'Building bridges with Akosombo Muslim Community',
                'type' => 'photo',
                'file_path' => 'images/gallery/ecumenical-visit.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/ecumenical-visit.jpg',
                'category' => 'Interfaith Dialogue',
                'event_date' => '2025-03-15',
                'order' => 5,
                'featured' => true,
            ],
            [
                'title' => 'Cultural Celebration',
                'description' => 'Celebrating Ewe culture through traditional food',
                'type' => 'photo',
                'file_path' => 'images/gallery/cultural-celebration.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/cultural-celebration.jpg',
                'category' => 'Cultural Events',
                'event_date' => '2024-11-20',
                'order' => 6,
                'featured' => false,
            ],
            [
                'title' => 'Women\'s Fellowship Meeting',
                'description' => 'Women gathering for prayer and fellowship',
                'type' => 'photo',
                'file_path' => 'images/gallery/womens-fellowship.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/womens-fellowship.jpg',
                'category' => 'Fellowship',
                'event_date' => '2025-08-12',
                'order' => 7,
                'featured' => false,
            ],
            [
                'title' => 'Baptism Service',
                'description' => 'New believers being baptized',
                'type' => 'photo',
                'file_path' => 'images/gallery/baptism-service.jpg',
                'video_url' => null,
                'thumbnail' => 'images/gallery/thumbs/baptism-service.jpg',
                'category' => 'Sacraments',
                'event_date' => '2025-07-30',
                'order' => 8,
                'featured' => true,
            ],
            
            // Videos
            [
                'title' => 'YAF Donation to VRA Presby School',
                'description' => 'Video coverage of YAF\'s stationery donation',
                'type' => 'video',
                'file_path' => null,
                'video_url' => 'https://web.facebook.com/DamcityTv/videos/995266299298362',
                'thumbnail' => 'images/gallery/thumbs/yaf-donation-video.jpg',
                'category' => 'Community Outreach',
                'event_date' => '2025-05-26',
                'order' => 1,
                'featured' => true,
            ],
            [
                'title' => 'Ecumenical Visit Video',
                'description' => 'Interfaith dialogue with Muslim community',
                'type' => 'video',
                'file_path' => null,
                'video_url' => 'https://web.facebook.com/100070341725574/videos/2488763854790787',
                'thumbnail' => 'images/gallery/thumbs/ecumenical-video.jpg',
                'category' => 'Interfaith Dialogue',
                'event_date' => '2025-03-15',
                'order' => 2,
                'featured' => true,
            ],
            [
                'title' => 'Unlocking Ewe Culture Through Food',
                'description' => 'Cultural celebration video',
                'type' => 'video',
                'file_path' => null,
                'video_url' => 'https://www.youtube.com/watch?v=qsg6vwHZcDE',
                'thumbnail' => 'images/gallery/thumbs/ewe-culture-video.jpg',
                'category' => 'Cultural Events',
                'event_date' => '2024-11-20',
                'order' => 3,
                'featured' => false,
            ],
            [
                'title' => 'COVID-19 Protocol Adherence',
                'description' => 'Church service with safety protocols',
                'type' => 'video',
                'file_path' => null,
                'video_url' => 'https://www.youtube.com/watch?v=bbT06TR1tlA',
                'thumbnail' => 'images/gallery/thumbs/covid-protocol-video.jpg',
                'category' => 'Health & Safety',
                'event_date' => '2020-08-10',
                'order' => 4,
                'featured' => false,
            ],
        ];

        foreach ($mediaItems as $mediaData) {
            // Check if media already exists
            $exists = MediaGallery::where('title', $mediaData['title'])
                ->where('type', $mediaData['type'])
                ->exists();
            
            if (!$exists) {
                MediaGallery::create($mediaData);
                $this->command->info('✓ Created media: ' . $mediaData['title'] . ' (' . $mediaData['type'] . ')');
            } else {
                $this->command->info('⊙ Media already exists: ' . $mediaData['title']);
            }
        }

        $this->command->info('Media gallery seeding completed!');
    }
}
