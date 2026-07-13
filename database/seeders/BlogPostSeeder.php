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
        $posts = [
            [
                'title' => 'YAF Donates Stationery to VRA Presby School',
                'slug' => 'yaf-donates-stationery-vra-presby-school',
                'excerpt' => 'The Young Adults\' Fellowship (YAF) of the Presbyterian Church of Ghana, Monninger Congregation, Akosombo, led by its President Brother Stephen Addo and Fellowship Coordinator Mr Moses Teye Tetteh...',
                'content' => 'The Young Adults\' Fellowship (YAF) of the Presbyterian Church of Ghana, Monninger Congregation, Akosombo, led by its President Brother Stephen Addo and Fellowship Coordinator Mr Moses Teye Tetteh, District Minister and Resident Minister, Rev George Kwabi visited VRA Presby School to present stationery to final-year students. This outreach initiative demonstrates our commitment to supporting education in our community and investing in the future of our young people.',
                'author' => 'YAF Coordinator',
                'image' => 'images/news/yaf-donation.jpg',
                'published' => true,
                'published_at' => '2025-05-26 10:00:00',
            ],
            [
                'title' => 'Ecumenical Visit to Akosombo Muslim Community',
                'slug' => 'ecumenical-visit-akosombo-muslim-community',
                'excerpt' => 'Our congregation participated in an ecumenical visit to the Akosombo Muslim Community, fostering interfaith dialogue and building bridges of understanding...',
                'content' => 'Our congregation participated in an ecumenical visit to the Akosombo Muslim Community, fostering interfaith dialogue and building bridges of understanding and peace in our community. This visit exemplifies our commitment to promoting unity, respect, and peaceful coexistence among different faith communities in Akosombo.',
                'author' => 'Church Secretary',
                'image' => 'images/news/ecumenical-visit.jpg',
                'published' => true,
                'published_at' => '2025-03-15 10:00:00',
            ],
            [
                'title' => 'Unlocking Ewe Culture Through Food',
                'slug' => 'unlocking-ewe-culture-through-food',
                'excerpt' => 'Experience the rich traditions of Ewe culture through our celebration of Ghanaian delights. Discover the heritage and flavors that make our cultural celebrations special.',
                'content' => 'Experience the rich traditions of Ewe culture through our celebration of Ghanaian delights. Discover the heritage and flavors that make our cultural celebrations special. This event brought together members of our congregation to celebrate and preserve our cultural heritage through traditional foods and customs.',
                'author' => 'Cultural Committee',
                'image' => 'images/news/ewe-culture-food.jpg',
                'published' => true,
                'published_at' => '2024-11-20 10:00:00',
            ],
            [
                'title' => '90% Score for COVID-19 Protocol Adherence',
                'slug' => 'covid-19-protocol-adherence',
                'excerpt' => 'Monninger Presby Church scored 90% at first service after the lifting of ban on churches. Damcity TV visited to fellowship and observe adherence to all government protocols...',
                'content' => 'Monninger Presby Church scored 90% at first service after the lifting of ban on churches. Damcity TV visited to fellowship and observe adherence to all government protocols. Kudos to Monninger Presby, Akosombo for outstanding performance! Our commitment to health and safety while maintaining our worship services demonstrates our care for the wellbeing of our congregation and community.',
                'author' => 'Health & Safety Team',
                'image' => 'images/news/covid-protocol.jpg',
                'published' => true,
                'published_at' => '2020-08-10 10:00:00',
            ],
        ];

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
