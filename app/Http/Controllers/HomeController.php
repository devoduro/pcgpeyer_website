<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Sermon;
use App\Models\Ministry;
use App\Models\Gallery;
use App\Models\Video;
use App\Support\DevotionService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(DevotionService $devotions)
    {
        $todaysDevotional = $devotions->todaysDevotional();

        $announcements = Announcement::active()->take(5)->get();

        // Get latest 4 posts for carousel display
        $latestPosts = BlogPost::where('published', true)
            ->latest('published_at')
            ->take(4)
            ->get();
            
        $upcomingEvents = Event::where('published', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(3)
            ->get();
            
        $latestSermons = Sermon::latest('sermon_date')
            ->take(3)
            ->get();
            
        $featuredMinistries = Ministry::where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('name')
            ->take(8)
            ->get();
            
        $latestGalleries = Gallery::with('images')
            ->latest()
            ->take(8)
            ->get();
            
        $latestVideos = Video::published()
            ->orderByDesc('featured')->latest('publish_date')
            ->take(6)
            ->get();
        
        return view('home', compact('todaysDevotional', 'announcements', 'latestPosts', 'upcomingEvents', 'latestSermons', 'featuredMinistries', 'latestGalleries', 'latestVideos'));
    }
}
