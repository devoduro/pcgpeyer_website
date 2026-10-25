<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Christmas Carol Service',
                'description' => 'Join us for our annual Christmas Carol Service as we celebrate the birth of our Savior through songs, scripture readings, and fellowship.',
                'location' => 'Peyer Memorial Congregation Main Sanctuary',
                'start_date' => '2025-12-24 18:00:00',
                'end_date' => '2025-12-24 20:00:00',
                'image' => 'images/events/christmas-carol.jpg',
                'category' => 'Special Services',
                'published' => true,
            ],
            [
                'title' => 'New Year Watchnight Service',
                'description' => 'Welcome the new year with prayer, worship, and thanksgiving as we reflect on God\'s faithfulness and seek His guidance for the year ahead.',
                'location' => 'Peyer Memorial Congregation Main Sanctuary',
                'start_date' => '2025-12-31 22:00:00',
                'end_date' => '2026-01-01 01:00:00',
                'image' => 'images/events/watchnight-service.jpg',
                'category' => 'Special Services',
                'published' => true,
            ],
            [
                'title' => 'Youth Conference 2026',
                'description' => 'An empowering conference for young people featuring dynamic speakers, worship sessions, and workshops on faith, leadership, and purpose.',
                'location' => 'Peyer Memorial Congregation Conference Hall',
                'start_date' => '2026-02-14 09:00:00',
                'end_date' => '2026-02-16 17:00:00',
                'image' => 'images/events/youth-conference.jpg',
                'category' => 'Conferences',
                'published' => true,
            ],
            [
                'title' => 'Women\'s Day Celebration',
                'description' => 'Celebrating and honoring the women of our congregation with special worship, testimonies, and fellowship.',
                'location' => 'Peyer Memorial Congregation Main Sanctuary',
                'start_date' => '2026-03-08 10:00:00',
                'end_date' => '2026-03-08 14:00:00',
                'image' => 'images/events/womens-day.jpg',
                'category' => 'Celebrations',
                'published' => true,
            ],
            [
                'title' => 'Easter Sunrise Service',
                'description' => 'Celebrate the resurrection of our Lord Jesus Christ with an early morning service filled with worship and praise.',
                'location' => 'Peyer Memorial Congregation Grounds',
                'start_date' => '2026-04-05 06:00:00',
                'end_date' => '2026-04-05 08:00:00',
                'image' => 'images/events/easter-sunrise.jpg',
                'category' => 'Special Services',
                'published' => true,
            ],
            [
                'title' => 'Community Health Fair',
                'description' => 'Free health screenings, medical consultations, and health education for our community members.',
                'location' => 'Peyer Memorial Congregation Compound',
                'start_date' => '2026-05-10 08:00:00',
                'end_date' => '2026-05-10 15:00:00',
                'image' => 'images/events/health-fair.jpg',
                'category' => 'Community Outreach',
                'published' => true,
            ],
        ];

        foreach ($events as $eventData) {
            // Check if event already exists
            $exists = Event::where('title', $eventData['title'])
                ->where('start_date', $eventData['start_date'])
                ->exists();
            
            if (!$exists) {
                Event::create($eventData);
                $this->command->info('✓ Created event: ' . $eventData['title']);
            } else {
                $this->command->info('⊙ Event already exists: ' . $eventData['title']);
            }
        }

        $this->command->info('Events seeding completed!');
    }
}
