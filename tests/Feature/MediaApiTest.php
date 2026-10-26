<?php

namespace Tests\Feature;

use App\Models\Devotional;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MediaApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $base = dirname(__DIR__, 2);
        Artisan::call('migrate:fresh', [
            '--realpath' => true,
            '--path' => [
                "$base/database/migrations/2024_01_01_000000_create_users_table.php",
                "$base/database/migrations/2025_06_06_183239_create_galleries_table.php",
                "$base/database/migrations/2025_06_06_183241_create_gallery_images_table.php",
                "$base/database/migrations/2025_11_18_061205_add_category_to_galleries_table.php",
                "$base/database/migrations/2025_07_05_014630_create_videos_table.php",
                "$base/database/migrations/2026_10_17_000001_create_members_table.php",
                "$base/database/migrations/2026_10_17_000002_create_app_users_table.php",
                "$base/database/migrations/2026_10_18_000001_create_devotionals_tables.php",
                "$base/vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",
            ],
        ]);
        $this->travelTo(Carbon::parse('2026-03-10 08:00:00', 'UTC'));
        config(['devotion.timezone' => 'Africa/Accra', 'devotion.policy' => 'required']);
    }

    private function album(array $over = []): Gallery
    {
        $admin = User::first() ?? User::forceCreate(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('x')]);

        return Gallery::create($over + ['title' => 'Harvest 2025', 'thumbnail_path' => 'galleries/thumbnails/h.jpg', 'created_by' => $admin->id]);
    }

    public function test_videos_match_the_website_published_only_newest_featured_first(): void
    {
        Video::create(['title' => 'Old sermon', 'video_type' => 'youtube', 'video_url' => 'https://www.youtube.com/watch?v=bbT06TR1tlA', 'category' => 'Sermons']);
        Video::create(['title' => 'Featured', 'video_type' => 'youtube', 'video_url' => 'https://youtu.be/abcdefghijk', 'featured' => true, 'category' => 'Events']);
        Video::create(['title' => 'Draft', 'video_type' => 'youtube', 'video_url' => 'https://youtu.be/zzzzzzzzzzz', 'published' => false]);
        Video::create(['title' => 'Tomorrow', 'video_type' => 'youtube', 'video_url' => 'https://youtu.be/yyyyyyyyyyy', 'publish_date' => '2026-03-11']);

        $res = $this->getJson('/api/v1/media/videos')->assertOk();

        $this->assertSame(['Featured', 'Old sermon'], array_column($res->json('videos'), 'title'));
        $res->assertJsonPath('videos.1.youtube_id', 'bbT06TR1tlA')
            ->assertJsonPath('videos.1.watch_url', 'https://www.youtube.com/watch?v=bbT06TR1tlA')
            ->assertJsonPath('videos.1.thumbnail_url', 'https://img.youtube.com/vi/bbT06TR1tlA/maxresdefault.jpg')
            ->assertJsonPath('categories', ['Events', 'Sermons'])
            ->assertJsonPath('meta.total', 2);

        $this->getJson('/api/v1/media/videos?category=Sermons')->assertJsonCount(1, 'videos');
    }

    public function test_uploaded_videos_point_at_the_stored_file(): void
    {
        Video::create(['title' => 'Choir', 'video_type' => 'upload', 'video_file' => 'videos/choir.mp4', 'thumbnail' => 'videos/choir.jpg']);

        $this->getJson('/api/v1/media/videos')
            ->assertJsonPath('videos.0.watch_url', asset('storage/videos/choir.mp4'))
            ->assertJsonPath('videos.0.thumbnail_url', asset('storage/videos/choir.jpg'));
    }

    public function test_photo_albums_with_cover_count_and_category_filter(): void
    {
        $a = $this->album(['category' => 'Special Events', 'is_featured' => true]);
        GalleryImage::create(['gallery_id' => $a->id, 'image_path' => 'galleries/images/2.jpg', 'display_order' => 2]);
        GalleryImage::create(['gallery_id' => $a->id, 'image_path' => 'galleries/images/1.jpg', 'display_order' => 1, 'caption' => 'Procession']);
        $this->album(['title' => 'Youth camp', 'category' => 'Youth']);

        $res = $this->getJson('/api/v1/media/photos')->assertOk();
        $res->assertJsonPath('albums.0.title', 'Harvest 2025')
            ->assertJsonPath('albums.0.photo_count', 2)
            ->assertJsonPath('albums.0.cover_url', asset('storage/galleries/thumbnails/h.jpg'))
            ->assertJsonPath('categories', ['Special Events', 'Youth']);

        $this->getJson('/api/v1/media/photos?category=Youth')->assertJsonCount(1, 'albums')->assertJsonPath('albums.0.title', 'Youth camp');

        $this->getJson("/api/v1/media/photos/{$a->id}")->assertOk()
            ->assertJsonPath('album.photos.0.url', asset('storage/galleries/images/1.jpg'))
            ->assertJsonPath('album.photos.0.caption', 'Procession')
            ->assertJsonCount(2, 'album.photos');

        $this->getJson('/api/v1/media/photos/999')->assertNotFound();
    }

    public function test_videos_follow_the_devotion_lock_but_photos_do_not(): void
    {
        Devotional::create(['publish_date' => '2026-03-10', 'title' => 'Today', 'scripture_reference' => 'John 3:16',
            'reflection' => '<p>Reflect.</p>', 'published' => true]);
        $token = $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama Owusu', 'email' => 'ama@example.com', 'phone' => '0200111222',
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->json('token');

        $this->withToken($token)->getJson('/api/v1/media/videos')->assertStatus(423);
        $this->withToken($token)->getJson('/api/v1/media/photos')->assertOk();
    }
}
