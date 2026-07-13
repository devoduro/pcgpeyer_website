<?php

namespace Database\Seeders;

use App\Models\Sermon;
use Illuminate\Database\Seeder;

class SermonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sermons = [
            [
                'title' => 'Walking in Faith',
                'preacher' => 'Rev. George Kwabi',
                'scripture_reference' => 'Hebrews 11:1-6',
                'description' => 'A powerful message about living by faith and trusting God in all circumstances.',
                'sermon_date' => '2025-11-10',
                'audio_url' => null,
                'video_url' => null,
                'thumbnail' => 'images/sermons/walking-in-faith.jpg',
                'series' => 'Faith Series',
                'featured' => true,
            ],
            [
                'title' => 'The Power of Prayer',
                'preacher' => 'Rev. George Kwabi',
                'scripture_reference' => 'Matthew 6:5-15',
                'description' => 'Understanding the importance and effectiveness of prayer in the believer\'s life.',
                'sermon_date' => '2025-11-03',
                'audio_url' => null,
                'video_url' => null,
                'thumbnail' => 'images/sermons/power-of-prayer.jpg',
                'series' => 'Prayer Life',
                'featured' => false,
            ],
            [
                'title' => 'Love One Another',
                'preacher' => 'Rev. George Kwabi',
                'scripture_reference' => 'John 13:34-35',
                'description' => 'Christ\'s commandment to love one another as He has loved us.',
                'sermon_date' => '2025-10-27',
                'audio_url' => null,
                'video_url' => null,
                'thumbnail' => 'images/sermons/love-one-another.jpg',
                'series' => 'Love Series',
                'featured' => false,
            ],
            [
                'title' => 'The Great Commission',
                'preacher' => 'Rev. George Kwabi',
                'scripture_reference' => 'Matthew 28:16-20',
                'description' => 'Our calling to spread the Gospel to all nations.',
                'sermon_date' => '2025-10-20',
                'audio_url' => null,
                'video_url' => null,
                'thumbnail' => 'images/sermons/great-commission.jpg',
                'series' => 'Mission & Evangelism',
                'featured' => true,
            ],
        ];

        foreach ($sermons as $sermonData) {
            // Check if sermon already exists
            $exists = Sermon::where('title', $sermonData['title'])
                ->where('sermon_date', $sermonData['sermon_date'])
                ->exists();
            
            if (!$exists) {
                Sermon::create($sermonData);
                $this->command->info('✓ Created sermon: ' . $sermonData['title']);
            } else {
                $this->command->info('⊙ Sermon already exists: ' . $sermonData['title']);
            }
        }

        $this->command->info('Sermons seeding completed!');
    }
}
