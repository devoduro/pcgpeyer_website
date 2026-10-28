<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Ministry;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Brings recent content from the congregation's own channels onto the website: services and
 * short messages from youtube.com/@bantamapresby, and flyers, photos and stories from
 * facebook.com/BantamaPresby (October 2026). Safe to re-run.
 */
class SocialMediaContentSeeder extends Seeder
{
    private const CHANNEL = 'https://www.youtube.com/@bantamapresby';

    public function run(): void
    {
        $this->seedVideos();
        $this->seedStories();
        $this->seedHarvestRevival();
        $this->seedYouthGallery();
        $this->seedGroups();
    }

    /** Inter-generational groups, from the groups' flyers and services on the YouTube channel. */
    private function seedGroups(): void
    {
        $groups = [
            'shekinah-singers' => [
                'name' => 'Shekinah Singers',
                'ministry_category' => 'Singers',
                'age_range' => 'Young adults',
                'description' => 'The Shekinah Singing Ministry leads worship in song and music, and hosts the annual GloPraise concert and The Cross on Good Friday.',
                'content' => "The Shekinah Singing Ministry (Shekinah Singers) is a singing and instrumental ministry of Peyer Memorial Congregation. Its singers and instrumentalists lead worship in song at our services and minister at programmes in the church and beyond.\n\n"
                    . "Each year the group presents GloPraise, a praise concert at Bantama Presby Church. GloPraise 2024, on Sunday 28th July 2024, had the theme \"Nyame Ye\" (Psalm 107:1), with guest groups Vessels of Honour (KNUST), NUPS-G Choir (KNUST), Royal Generation Choir (KNUST), Gospel Arts (PMPC) and Restoration Voices (Ramseyer Presby Church). GloPraise 2025, on Sunday 24th August 2025, was an album launch and live recording concert.\n\n"
                    . "On Good Friday, 3rd April 2026, the Shekinah Singing Ministry and Peyer Memorial Congregation presented The Cross 2026, a night of jazz music on the theme \"At the Cross of Jesus\" (Galatians 6:14).\n\n"
                    . "Concerts and songs by the group are on the church's YouTube channel, " . self::CHANNEL . ", and in the Music section of our video gallery.",
                'image' => 'shekinah_singers',
                'location' => 'Church Auditorium',
                'meeting_schedule' => null,
            ],
            'singing-bands-union' => [
                'name' => 'Singing Band',
                'ministry_category' => 'Singers',
                'description' => 'The Singing Band ministers through traditional and choral singing at Sunday worship, weddings, funerals and church programmes.',
                'content' => "The Singing Band is a musical and spiritual fellowship within Peyer Memorial Congregation, made up of members who minister through traditional and choral singing. It belongs to the Singing Bands' Union of the Presbyterian Church of Ghana.\n\n"
                    . "The group worships and glorifies God through music, supports church services and programmes with song, promotes Christian fellowship among members, and evangelizes through outreach performances. The Singing Band takes part in Sunday worship, weddings, funerals and special church events, and represents the congregation at District, Presbytery and National Singing Bands programmes.\n\n"
                    . "The Singing Band celebrates its anniversary on Music Sunday. In 2026 this fell on Sunday 22nd February, with the theme \"Encountering God's glory for transformed life through music\" and Mr. Kwasi Afrane as preacher.\n\n"
                    . "From Thursday 9th to Sunday 12th April 2026, Peyer Memorial Congregation hosted the 73rd Annual Conference of the Asante Presbytery Singing Bands' Union, on the theme \"Celebrating our heritage: building on the foundation already laid. Our music, our impact\" (1 Corinthians 3:11; Acts 16:25-26). The conference ran from an official opening through evening sessions to a durbar and music fest.",
                'image' => 'singing_band',
                'location' => 'Church Auditorium',
                'meeting_schedule' => 'Sundays, after 2nd Service',
            ],
            'boys-and-girls-brigade' => [
                'name' => "Boys' and Girls' Brigade",
                'ministry_category' => 'Uniformed Group',
                'age_range' => 'Children and youth',
                'description' => "The Powerful 11th Kumasi Company trains boys and girls in Christian discipline, service and leadership.",
                'content' => "The Boys' and Girls' Brigade at Peyer Memorial Congregation is the Powerful 11th Kumasi Company. Through drill, Bible class, games and service, the Brigade helps boys and girls grow in Christian character, discipline, self-respect and leadership.\n\n"
                    . "The Brigade takes part in church festivals and processions, and new members are received at enrolment services in the church.",
                'image' => 'brigade_band',
                'location' => 'Church Premises',
                'meeting_schedule' => null,
            ],
        ];

        foreach ($groups as $slug => $group) {
            $image = $group['image'];
            unset($group['image']);
            Ministry::updateOrCreate(['slug' => $slug], $group + [
                'category' => 'inter-generational',
                'image' => $this->publish($image, 'ministries'),
                'active' => true,
            ]);
        }
        $this->command->info('Groups: ' . implode(', ', array_column($groups, 'name')) . '.');
    }

    /** Selected services and clips from the YouTube channel, newest first. */
    private function seedVideos(): void
    {
        // [id, title, description, category, publish date, length in seconds, featured]
        $videos = [
            ['R4DCNQevkUY', 'End-of-Year Harvest Revival: "Make a small loaf from what you have"',
                'Opening night of the End-of-Year Harvest Revival, with guest speaker Rev. Francis Fiahenoo. Theme: "Make a small loaf from what you have... bring it to me" (1 Kings 17:13).',
                'Revival & Prayer', '2026-10-26', 8475, true],
            ['KnxxE1usbPo', 'Induction Service for Chaplain: "Love, the Greatest Commandment"',
                'Second service on Sunday 25th October 2026, including the induction of a chaplain for Prempeh College.',
                'Special Services', '2026-10-25', 13683, true],
            ['0o6Pwwje3sU', 'Moma Ye Mo Se by BMC Ghana', 'A ministration by BMC Ghana.',
                'Music', '2026-10-21', 143, false],
            ['3u7yC_7TGJc', 'Children and Junior Youth Harvest: "Render to God what is God\'s"',
                'First service on Sunday 18th October 2026, led by our children and Junior Youth at their harvest.',
                'Sunday Services', '2026-10-18', 10620, false],
            ['Pi3LY8Dtus8', 'All Night Service: "He became a curse, that we might receive the blessing of Abraham"',
                'All night service of prayer, praise and the Word, Friday 16th October 2026.',
                'Revival & Prayer', '2026-10-16', 14451, false],
            ['Nu3WOHS8Jss', 'Education and Communion Sunday: "Expanding the Frontiers of Education with the Gospel"',
                'First service on Education Sunday, 11th October 2026, with Holy Communion.',
                'Sunday Services', '2026-10-11', 8464, false],
            ['W8poK1W6Ju8', 'Be Nice to People',
                'A short weekend word from Rev. Dr. Kofi Amfo-Akonnor: be kind to people, because we do not know whom we will meet tomorrow.',
                'Short Messages', '2026-10-10', 99, false],
            ['PG7NdrDEuUM', 'Induction Service for Rev. Dr. Kofi Amfo-Akonnor',
                'First service on Sunday 4th October 2026, inducting Rev. Dr. Kofi Amfo-Akonnor as Bantama District Minister and Minister in Charge of Peyer Memorial Congregation.',
                'Special Services', '2026-10-04', 1137, true],
            ['9eYC8MlPPrQ', 'In His Presence with Rev. Samuel Boansi (October Edition)',
                'The October edition of In His Presence, an evening of worship and prayer led by Rev. Samuel Boansi, 1st October 2026.',
                'Revival & Prayer', '2026-10-01', 2922, false],
            ['y6BGSImbfHA', 'Blue Cross Sunday', 'First service on Blue Cross Sunday, 27th September 2026.',
                'Sunday Services', '2026-09-27', 9930, false],
            ['DXAnYnQeb88', 'Yeda Wo Ase by Shekina', 'Shekina sings "Yeda wo ase", thanking God for how far He has brought us.',
                'Music', '2026-09-27', 85, false],
            ['tfLB-zjuusY', 'Scholarship Sunday: "Sponsor a Destiny"',
                'First service on Scholarship Sunday, 13th September 2026.',
                'Sunday Services', '2026-09-13', 10210, false],
            ['TSCwWzAwkI4', 'Retirement Service in Honour of Rev. Timothy Ernest Annoh',
                'Second service on Sunday 6th September 2026, giving thanks for Rev. Timothy Ernest Annoh and family and 36 years of ministry.',
                'Special Services', '2026-09-06', 16064, false],
            ['MadmrZbMn-c', 'Thanksgiving and Praise Night for Rev. Timothy Ernest Annoh and Family',
                'An evening of thanksgiving and praise in honour of Rev. Timothy Ernest Annoh and family on his retirement.',
                'Special Services', '2026-09-06', 6560, false],
            ['E27-6QKR1l8', 'Mercy Beyond Boundaries', 'The full video of "Mercy beyond boundaries".',
                'Music', '2026-08-18', 2273, false],
            ['ASVZ_TK18n8', 'Two Spiritual Operating Systems', 'A short teaching by Rev. Timothy Ernest Annoh.',
                'Short Messages', '2026-07-15', 143, false],
            ['s1rT6kV7CZo', "God's Promises Are Reliable", "A short word on the faithfulness of God's promises.",
                'Short Messages', '2026-05-04', 95, false],
            ['iWC8DxXVAH0', 'Ka Ma Obia Nte by the Church Choir', 'A piece from the Church Choir.',
                'Music', '2026-09-29', 99, false],
            ['4-5vYQu7jGc', 'YAF Week Celebration: Worship Night', 'Worship night during the Young Adult Fellowship week celebration.',
                'Music', '2026-04-24', 1923, false],
            ['01KGOjkkeus', "Asante Presbytery Singing Bands' Union 73rd Annual Conference: Music Fest",
                "Music fest of the Asante Presbytery Singing Bands' Union 73rd Annual Conference, hosted at Peyer Memorial Congregation, Bantama, on Saturday 11th April 2026.",
                'Music', '2026-04-11', 25203, false],
            ['ftcZJVGPjKc', 'The Cross 2026: "At the Cross of Jesus"',
                'A night of jazz music on Good Friday, 3rd April 2026, presented by the Shekinah Singing Ministry and Peyer Memorial Congregation. Theme: "At the Cross of Jesus" (Galatians 6:14).',
                'Music', '2026-04-03', 13801, false],
            ['Qvx1j8_0neI', 'Music Sunday and Singing Band Anniversary',
                "First service on Sunday 22nd February 2026. Theme: \"Encountering God's glory for transformed life through music\". Preacher: Mr. Kwasi Afrane.",
                'Music', '2026-02-22', 7981, false],
            ['4XTW_uy-FBM', 'Bantama YPG Gospel Arts: Choreogosmupoedrafest 25',
                "The Young People's Guild festival of gospel choreography, music, poetry and drama, Sunday 7th September 2025.",
                'Music', '2025-09-07', 9476, false],
            ['Qz3BF0hcoug', 'GloPraise 2025: Album Launch and Live Recording Concert',
                'The Shekinah Singing Ministry album launch and live recording concert, Sunday 24th August 2025.',
                'Music', '2025-08-24', 10857, false],
            ['JNVSy7_oZDI', 'GloPraise 2024: "Nyame Ye"',
                'Shekinah Singers at GloPraise 2024, Sunday 28th July 2024. Theme: "Nyame Ye" (Psalm 107:1).',
                'Music', '2024-07-28', 1658, false],
        ];

        foreach ($videos as [$id, $title, $description, $category, $date, $seconds, $featured]) {
            Video::updateOrCreate(
                ['video_url' => "https://www.youtube.com/watch?v={$id}"],
                [
                    'title' => $title,
                    'description' => $description,
                    'video_type' => 'youtube',
                    'thumbnail' => null,
                    'duration' => $this->duration($seconds),
                    'featured' => $featured,
                    'published' => true,
                    'publish_date' => $date,
                    'category' => $category,
                ]
            );
        }
        $this->command->info('Videos: ' . count($videos) . ' from ' . self::CHANNEL . '.');
    }

    /** News stories from the induction and retirement services. */
    private function seedStories(): void
    {
        $stories = [
            [
                'slug' => 'rev-dr-kofi-amfo-akonnor-inducted',
                'title' => 'Rev. Dr. Kofi Amfo-Akonnor Inducted as Minister in Charge',
                'excerpt' => 'On Sunday 4th October 2026 the congregation inducted Rev. Dr. Kofi Amfo-Akonnor as Bantama District Minister and Minister in Charge of Peyer Memorial Congregation.',
                'content' => "On Sunday 4th October 2026, Peyer Memorial Congregation held an induction service for Rev. Dr. Kofi Amfo-Akonnor, our new Bantama District Minister and Minister in Charge of the congregation. Both services, at 6:45am and 9:30am, were given to the induction.\n\n"
                    . "We welcome Rev. Dr. Amfo-Akonnor and his family to Bantama, and we pray that God will bless his ministry among us.\n\n"
                    . "Watch the first service: https://www.youtube.com/watch?v=PG7NdrDEuUM",
                'image' => 'induction_amfo_akonnor',
                'published_at' => '2026-10-04 12:00:00',
            ],
            [
                'slug' => 'retirement-rev-timothy-ernest-annoh',
                'title' => 'Thanksgiving for Rev. Timothy Ernest Annoh: 36 Years of Ministry',
                'excerpt' => 'The congregation gave thanks for Rev. Timothy Ernest Annoh and family at a retirement service on Sunday 6th September 2026, after 36 years of ministry.',
                'content' => "On Sunday 6th September 2026, Peyer Memorial Congregation held a retirement service in honour of Rev. Timothy Ernest Annoh and family, marking 36 years of faithful ministry. The day began with a Thanksgiving and Praise Night, and both Sunday services were given to the celebration.\n\n"
                    . "We thank God for Rev. Annoh's years of service and for all he gave to this congregation, and we wish him and his family God's blessing in retirement.\n\n"
                    . "Watch the retirement service: https://www.youtube.com/watch?v=TSCwWzAwkI4\n"
                    . "Watch the Thanksgiving and Praise Night: https://www.youtube.com/watch?v=MadmrZbMn-c",
                'image' => 'valedictory_annoh',
                'published_at' => '2026-09-06 18:00:00',
            ],
        ];

        foreach ($stories as $story) {
            BlogPost::updateOrCreate(['slug' => $story['slug']], [
                'title' => $story['title'],
                'excerpt' => $story['excerpt'],
                'content' => $story['content'],
                'author' => 'Peyer Memorial Media',
                'image' => $this->publish($story['image'], 'blog'),
                'published' => true,
                'published_at' => $story['published_at'],
            ]);
        }
        $this->command->info('Stories: ' . count($stories) . ' news posts.');
    }

    /** The End-of-Year Harvest Revival flyer, as a news post, an event and an announcement. */
    private function seedHarvestRevival(): void
    {
        $flyer = $this->publish('harvest_revival_2026', 'blog');

        $post = BlogPost::updateOrCreate(['slug' => 'end-of-year-harvest-revival-2026'], [
            'title' => 'End-of-Year Harvest Revival, 26th to 30th October',
            'excerpt' => 'Join us every evening at 5:30pm from Monday 26th to Friday 30th October, with guest speaker Rev. Francis Fiahenoo.',
            'content' => "Through the storms and sunshine, God has remained faithful. Every blessing is a reason to worship, every testimony is a reason to give thanks, and every new day is another opportunity to experience His grace.\n\n"
                . "As we celebrate our End-of-Year Harvest Revival, let us gather in His presence to thank Him for His faithfulness, celebrate His goodness, and renew our commitment to Him.\n\n"
                . "Theme: \"Make a small loaf from what you have... bring it to me\" (1 Kings 17:13)\n"
                . "Guest speaker: Rev. Francis Fiahenoo\n"
                . "Host: Rev. Dr. Kofi Amfo-Akonnor, Bantama District Minister\n"
                . "When: Monday 26th to Friday 30th October 2026, 5:30pm each evening\n"
                . "Where: Bantama Presby (Peyer Memorial Congregation)\n\n"
                . "Vehicles will be provided. Each evening is streamed live on our YouTube channel: " . self::CHANNEL,
            'author' => 'Peyer Memorial Media',
            'image' => $flyer,
            'published' => true,
            'published_at' => '2026-10-22 09:00:00',
        ]);

        Event::updateOrCreate(['title' => 'End-of-Year Harvest Revival'], [
            'description' => "Five evenings of thanksgiving, praise and the Word with guest speaker Rev. Francis Fiahenoo. Theme: \"Make a small loaf from what you have... bring it to me\" (1 Kings 17:13). Vehicles will be provided.",
            'location' => 'Peyer Memorial Presbyterian Church, Bantama',
            'start_date' => '2026-10-26 17:30:00',
            'end_date' => '2026-10-30 17:30:00',
            'image' => $flyer,
            'category' => 'Revival',
            'published' => true,
        ]);

        Announcement::updateOrCreate(['title' => 'End-of-Year Harvest Revival'], [
            'message' => 'Every evening at 5:30pm until Friday 30th October, with guest speaker Rev. Francis Fiahenoo. Vehicles will be provided.',
            'type' => 'event',
            'link_url' => route('news-update.show', $post->slug, false),
            'link_text' => 'Details',
            'starts_at' => '2026-10-22 00:00:00',
            'expires_at' => '2026-10-30 23:59:59',
            'pinned' => true,
            'published' => true,
            'display_order' => 0,
        ]);
        $this->command->info('Harvest Revival: news post, event and announcement.');
    }

    /** Photo set posted to Facebook in October 2026. */
    private function seedYouthGallery(): void
    {
        $gallery = Gallery::updateOrCreate(
            ['title' => 'Young People in Church, October 2026'],
            [
                'description' => 'Students and young people filled the church in October 2026. Photos from our Facebook page, facebook.com/BantamaPresby.',
                'category' => 'Church Events',
                'thumbnail_path' => $this->publish('youth_programme_hall', 'galleries/bantama'),
                'is_featured' => false,
                'created_by' => User::where('role', 'admin')->value('id') ?? User::value('id'),
            ]
        );

        $images = [
            'youth_programme_hall' => 'A full church of students and young people',
            'youth_programme_students' => 'Students in the pews',
            'youth_programme_listening' => 'Listening to the programme',
            'youth_programme_speaker' => 'A student addresses the gathering',
            'youth_programme_speaker_2' => 'Speaking to the congregation',
            'youth_programme_stage' => 'At the front of the church',
        ];

        GalleryImage::where('gallery_id', $gallery->id)->delete();
        $order = 0;
        foreach ($images as $photo => $caption) {
            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'image_path' => $this->publish($photo, 'galleries/bantama'),
                'caption' => $caption,
                'display_order' => $order++,
            ]);
        }
        $this->command->info('Galleries: "' . $gallery->title . '" with ' . count($images) . ' photos.');
    }

    private function duration(int $seconds): string
    {
        $h = intdiv($seconds, 3600);
        $m = intdiv($seconds % 3600, 60);
        $s = $seconds % 60;

        return $h ? sprintf('%d:%02d:%02d', $h, $m, $s) : sprintf('%d:%02d', $m, $s);
    }

    /** Copies a bundled photo from public/images/bantama onto the public disk and returns its path. */
    private function publish(string $photo, string $dir): string
    {
        $path = "{$dir}/{$photo}.jpg";
        if (! Storage::disk('public')->exists($path)) {
            Storage::disk('public')->put($path, file_get_contents(public_path("images/bantama/{$photo}.jpg")));
        }

        return $path;
    }
}
