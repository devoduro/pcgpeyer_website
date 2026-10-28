<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Leadership;
use App\Models\LeadershipTitle;
use App\Models\Ministry;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Replaces content that was carried over from another congregation's website (Rev. Friedrich
 * Monninger Congregation, Akosombo) with Peyer Memorial Congregation's own records, taken from
 * the congregation's 60th anniversary brochure (19th November 2017). Safe to re-run.
 *
 * Nothing Monninger-related is deleted outright except demo posts and galleries: leadership
 * records are deactivated, so they can be restored from the dashboard if needed.
 */
class BantamaContentSeeder extends Seeder
{
    /** Session and ministers from the other congregation's site. */
    private const MONNINGER_LEADERS = [
        'Rev. George Agyei Kwabi', 'Rev. Emmanuel Kwame Adofo', 'Eric Siako', 'Ernest Gyan Asare',
        'Cat. Emmanuel Ansah Brefo', 'Cat. Daniel Aboagye', 'Moses Teye Tetteh', 'Mrs. Esther Ofosua Asante',
        'Mrs. Emma Kay Holm', 'Mr. Ernest Gyan Asare', 'Mr. Eric Siako', 'Mr. Seth Obeng Adu',
        'Mr. Martin Agbenyegah', 'Mad. Christiana Darkoa', 'Mr. Samuel Yirenkyi Addo', 'Mrs. Margaret Debrah',
        'Ms. Yvette N.A. Amankwa - Youth Rep.', 'Mr. Sebastian Richard Danful', 'Mr. Samora Owusu Agyei',
        'Mr. William Avorkliyah', 'Mr. Eric Nyarko', 'Mr. Samuel Danso Kumi', 'Mrs. Elizabeth Bruce',
        'Mad. Christiana Boahene', 'Mr. Moses T. Tetteh', 'Mr. Samuel Anim Tieku', 'Mrs. Victoria Agbohla',
        'Ms. Elizabeth Quaye', 'Mr. Kelvin Kweku Donkor',
    ];

    /** Ministry "leaders" that were the other congregation's executives or placeholders. */
    private const MONNINGER_MINISTRY_LEADERS = [
        'Sis. Elizabeth M.D. Bruce', 'Ebenezer Akuffo', 'Bro. MARTIN AGBENYEGAH', "Children's Ministry Director",
        'J.Y Teachers', 'Yvette Donkor', 'Elizabeth Quaye', 'Sister Florence Asamoah', "Men's Ministry Leader",
    ];

    private const MONNINGER_POSTS = [
        '90-score-for-covid-19-protocol-adherence', 'ecumenical-visit-to-akosombo-muslim-community',
        'unlocking-ewe-culture-through-food', 'yaf-donates-stationery-to-vra-presby-school',
    ];

    private const MONNINGER_GALLERIES = [
        '2025 Traditional Sunday', "2025 Men's Week Thankgiving Service", 'Service In Honour of Hon. Thomas Ampem Nyarko',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            $this->retireMonningerContent();
            $this->seedPastLeaders();
            $this->updateMinistries();
            $this->seedAnniversaryGallery();
        });
    }

    private function retireMonningerContent(): void
    {
        $n = Leadership::whereIn('name', self::MONNINGER_LEADERS)->update(['active' => false, 'is_current' => false]);
        $this->command->info("Leadership: deactivated {$n} records from the other congregation.");

        $n = BlogPost::whereIn('slug', self::MONNINGER_POSTS)->delete();
        $this->command->info("News: removed {$n} draft posts about the other congregation.");

        $galleries = Gallery::whereIn('title', self::MONNINGER_GALLERIES)->get();
        foreach ($galleries as $gallery) {
            GalleryImage::where('gallery_id', $gallery->id)->delete();
            $gallery->delete();
        }
        $this->command->info("Galleries: removed {$galleries->count()} galleries from the other congregation.");
    }

    /** Pastors, catechists, senior presbyters and clerks, as listed in the 2017 brochure. */
    private function seedPastLeaders(): void
    {
        $title = fn (string $t) => LeadershipTitle::firstOrCreate(['title' => $t], ['description' => $t, 'active' => true])->id;

        $mic = $title('Minister-in-Charge');
        $minister = $title('Minister');
        $second = $title('Second Minister');
        $catechist = $title('Catechist');
        $senior = $title('Senior Presbyter');
        $clerk = $title('Session Clerk');
        $assistantClerk = $title('Assistant Session Clerk');

        // An earlier version seeded four of these pastors under "District Minister"; fold them in.
        Leadership::whereIn('name', ['Rev. S. R. Essah', 'Rev. S. S. Addi', 'Rev. M. O. Amoh', 'Rev. A. K. Sah'])
            ->where('is_current', false)->whereNull('served_from')->delete();

        // [name, title id, hometown, served from, served to, note]
        $pastors = [
            ['Rev. S. R. Essah', $mic, 'Anum', '1968-04-01', '1970-09-01', 'Appointed by the Asante Presbytery as the first resident minister, taking over the administration of the congregation from the Presbyters and headteacher-catechists.'],
            ['Rev. S. S. Addi', $mic, 'Begoro', '1970-09-25', '1971-03-20', 'The first confirmation ceremony in the church was performed during his tenure.'],
            ['Rev. M. O. Amoh', $mic, 'Dwomoh', '1971-03-25', '1978-03-12', 'The chapel was roofed, panelled and plastered, and membership grew to seven hundred. Bantama was elevated to District status in March 1978.'],
            ['Rev. S. O. Ayim', $mic, 'Asunafo', '1978-03-18', '1978-11-30', null],
            ['Rev. M. Y. Mireku', $mic, 'Nkwatia', '1978-12-01', '1980-09-20', 'The new pulpit was installed in 1980.'],
            ['Rev. D. A. Y. Larson', $mic, 'Kwabeng', '1980-09-20', '1982-10-08', null],
            ['Rev. A. A. Misah', $mic, 'Akwasiho', '1982-10-14', '1984-10-11', null],
            ['Rev. J. W. Amoah', $mic, 'Kokofu', '1984-11-01', '1985-04-02', 'Served the congregation as its catechist in its earliest years (1959-1960) before his ordination.'],
            ['Rev. A. K. Sah', $mic, 'Sekyedomase', '1985-04-03', '1991-10-04', 'Accelerated work on the chapel, fenced the church premises and introduced the "day-born" harvest. The church was dedicated and named Peyer Memorial Congregation in 1990.'],
            ['Rev. K. A. Nuamah', $mic, 'Apapam', '1991-09-04', '1995-09-27', null],
            ['Rev. V. A. Larbi', $mic, 'Adukrom', '1995-10-04', '1999-06-15', 'Built the three-room administrative block, and the Session began the new District Minister\'s manse in 1998.'],
            ['Rev. C. B. Ahwireng', $mic, 'Aburi', '1999-11-11', '2001-09-25', 'The District Minister\'s manse was completed during his tenure.'],
            ['Rev. E. Odame Asare', $second, 'Ayansu Akwamu', '2000-09-26', '2002-09-17', null],
            ['Rev. E. Agyem-Frempong', $mic, 'Bechem', '2001-09-27', '2007-10-01', 'The first District Minister to live in the new manse.'],
            ['Rev. A. A. Ampofo', $minister, 'Aburi', '2002-09-09', '2005-09-15', null],
            ['Rev. (Mrs.) Beatrix Adjanor Quarshie', $second, 'Teshie', '2005-09-01', '2009-09-01', null],
            ['Rev. P. K. Nyarkoh', $mic, 'Agona-Asamang', '2007-10-03', '2010-09-13', null],
            ['Rev. E. Omari', $second, 'Saso Buoho', '2008-09-13', '2012-09-25', null],
            ['Rev. Alexander Adu-Sekyere', $mic, 'Sampa', '2010-09-27', '2016-09-03', null],
            ['Rev. Samuel Adu-Gyamfi', $second, 'Pakyi No. 2', '2012-09-24', '2016-08-17', null],
        ];

        foreach ($pastors as $i => [$name, $titleId, $hometown, $from, $to, $note]) {
            $this->leader($name, $titleId, (int) substr($from, 0, 4), [
                'served_from' => $from,
                'served_to' => $to,
                'year_end' => (int) substr($to, 0, 4),
                'bio' => trim("Hometown: {$hometown}. " . ($note ?? '')),
                'display_order' => $i,
            ]);
        }

        // [name, title id, from year, to year, note]
        $others = [
            ['Mr. B. R. D. Anane', $catechist, 1957, 1959, 'Headteacher of Bantama Presbyterian School and the congregation\'s first catechist.'],
            ['Mr. J. W. Amoah', $catechist, 1959, 1960, 'Hometown: Kokofu. Later ordained, returning as Minister-in-Charge in 1984.'],
            ['Mr. J. A. Anyan', $catechist, 1960, 1960, null],
            ['Mr. C. O. Awuku', $catechist, 1960, 1968, 'Hometown: Akwapem. Later ordained as a Reverend Minister.'],
            ['Mr. G. Y. O. Martinson', $catechist, 1968, 1980, 'Hometown: Akwapem.'],
            ['Mr. E. S. Osei', $catechist, 1980, 1984, 'Hometown: Mprem (Mampong).'],
            ['Mr. P. K. Agyepong', $catechist, 1982, 2015, 'Hometown: Kwaso. Served the congregation as catechist for over thirty years.'],
            ['Mr. Kwame Ampem Darko', $catechist, 1992, 1999, 'Hometown: Agogo. Second Catechist, later ordained.'],

            ['Mr. I. O. Yeboah', $senior, 1978, 1996, null],
            ['Mr. Fred Asamoah', $senior, 1996, 1997, null],
            ['Mr. Kwasi Afrane Baning', $senior, 1997, 2000, null],
            ['Mr. Appiah Sarfo Kantanka', $senior, 2000, 2003, null],
            ['Dr. Joseph Opoku Fening', $senior, 2003, 2007, null],
            ['Mr. Kwasi Afrane Baning', $senior, 2007, 2013, null],
            ['Dr. Antwi Boasiako', $senior, 2013, 2017, null],

            ['Mr. G. Y. O. Martinson', $clerk, 1968, 1980, null],
            ['Mr. E. S. Osei', $clerk, 1980, 1984, null],
            ['Mr. P. K. Agyepong', $clerk, 1984, 1986, null],
            ['Mr. F. N. Fening', $clerk, 1986, 1994, null],
            ['Mr. Kwasi Afrane Baning', $assistantClerk, 1986, 1994, null],
            ['Rev. Yaw Opoku Danso', $clerk, 1994, 1996, null],
            ['Mr. S. Adu-Akwaboa', $clerk, 1996, 2000, null],
            ['Mr. Kwabena Adu-Gyamfi', $clerk, 2000, 2004, null],
            ['Mrs. Asha Obiri Darko', $clerk, 2005, 2009, null],
            ['Mr. S. Adu-Akwaboa', $assistantClerk, 2005, 2009, null],
            ['Mrs. Betty Asare Antwi-Duah', $clerk, 2010, 2013, null],
            ['Mr. James Owusu-Achiaw', $assistantClerk, 2010, 2013, null],
            ['Mr. James Owusu-Achiaw', $clerk, 2014, 2017, null],
            ['Mr. Paul Knight French', $assistantClerk, 2014, 2017, null],
        ];

        foreach ($others as $i => [$name, $titleId, $from, $to, $note]) {
            $this->leader($name, $titleId, $from, ['year_end' => $to, 'bio' => $note, 'display_order' => $i]);
        }

        $this->command->info('Leadership: ' . (count($pastors) + count($others)) . ' past leaders recorded.');
    }

    private function leader(string $name, int $titleId, int $year, array $attributes): void
    {
        Leadership::updateOrCreate(
            ['name' => $name, 'title_id' => $titleId, 'year' => $year],
            $attributes + ['title_text' => '', 'email' => '', 'phone' => '', 'image' => '', 'active' => true, 'is_current' => false]
        );
    }

    private function updateMinistries(): void
    {
        // The leaders and phone numbers belonged to the other congregation; leave them blank
        // until the current executives are entered from the dashboard.
        $n = Ministry::whereIn('leader', self::MONNINGER_MINISTRY_LEADERS)
            ->update(['leader' => null, 'leader_phone' => null, 'leader_picture' => null]);
        $this->command->info("Ministries: cleared {$n} leaders from the other congregation.");

        // Photos uploaded on the other congregation's site (Children's Service, Junior Youth, BSPG,
        // Singing Band). Cleared so the page falls back to a congregation photo until real ones are added.
        Ministry::whereIn('image', [
            'ministries/dn8pnTtvwtMtqsikfSQVqT6CVaLgiGjS51xaTWzx.png',
            'ministries/kUYJNMlvakMhTkvU7GZuqZA4fMfvMFS0IN3t8Z6B.png',
            'ministries/XX1aqvSRzQBTt8YY1u6SrHPggRcfD8loghdkSprJ.png',
            'ministries/UyzuVoRx2Rb6lInvmKfkkr8njIRgUcgj1oRVVuCy.png',
        ])->update(['image' => null]);

        $photos = [
            'mens-fellowship' => 'mens_fellowship',
            'womens-fellowship' => 'womens_fellowship',
            'young-adult-fellowship-yaf' => 'yaf',
            'young-peoples-guild-ypg' => 'ypg',
            'church-choir' => 'choir',
        ];
        foreach ($photos as $slug => $photo) {
            Ministry::where('slug', $slug)->update(['image' => $this->publish($photo, 'ministries')]);
        }

        Ministry::where('slug', 'bible-study-and-prayer-group-bspg')->update([
            'description' => 'Founded in 1961, the Bible Study and Prayer Group brought house-to-house evangelism and regular Bible study to the congregation.',
            'content' => "In 1961, Mr I. O. Yeboah, Mr George Marfo, Sis. Kate Amponsah, Sis. Dora Afriyie, Sis. Elizabeth Ataa, Sis. Juliana Marfo and Sis. Emelia Yeboah, members of the Bible Study and Prayer Group at Adum Ramseyer Church, decided to form a Bible Study and Prayer Group at Bantama Presbyterian Church. They were led by Mr J. A. T. Sarkodie of Adum Ramseyer Church, and began evangelism in full swing using the house-to-house method.\n\nThe first executives of the group were Mr J. A. T. Sarkodie (President), Mr George Marfo (Secretary), Mr I. O. Yeboah and Sis. Dora Afriyie (members). Among the first people won for Christ who later joined the group were Mr and Mrs Abraham Marfo, Ms Joana Sefa, Mrs Mary Pokuaa, Ms Beatrice Oteng, Mr E. Y. Boakye, Mr Fred Darko and Mr N. E. Kyeame.\n\nIn 1972, on the initiative of the group's secretary, Mr Fred Darko, a sub-group called the Evangelicals was formed to carry out the group's evangelistic work, with the objective of spreading the gospel no matter the cost.",
        ]);
    }

    private function seedAnniversaryGallery(): void
    {
        $gallery = Gallery::updateOrCreate(
            ['title' => 'Our Congregation at 60 (2017)'],
            [
                'description' => 'Peyer Memorial Congregation\'s groups and Session in the 60th anniversary year, from the anniversary brochure.',
                'category' => 'Church Events',
                'thumbnail_path' => $this->publish('womens_fellowship', 'galleries/bantama'),
                'is_featured' => true,
                'created_by' => User::where('role', 'admin')->value('id') ?? User::value('id'),
            ]
        );

        $images = [
            'womens_fellowship' => "Women's Fellowship",
            'mens_fellowship' => "Men's Fellowship",
            'choir' => 'Church Choir',
            'yaf' => 'Young Adult Fellowship (YAF)',
            'ypg' => "Young People's Guild (YPG)",
            'brigade_b' => "Boys' and Girls' Brigade (Powerful 11th Kumasi Company)",
            'brigade_a' => "Boys' and Girls' Brigade colour party",
            'session' => 'The Session of Peyer Memorial Congregation',
            'members_group' => 'Members of the congregation',
            'anniversary' => '60th Anniversary emblem, 1957-2017',
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
