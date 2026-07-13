<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Get published blog posts from database
        $posts = BlogPost::where('published', true)
            ->latest('published_at')
            ->paginate(12);
        
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        // Get single blog post by slug
        $post = BlogPost::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();
        
        // Get related posts
        $relatedPosts = BlogPost::where('published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        
        return view('blog.show', compact('post', 'relatedPosts'));
    }
    
    // Keep old hardcoded data as fallback/example
    private function getOldHardcodedData()
    {
        return $posts = [
            [
                'id' => 1,
                'title' => 'YAF Donates Stationery to VRA Presby School',
                'slug' => 'yaf-donates-stationery-vra-presby-school',
                'excerpt' => 'The Young Adults\' Fellowship (YAF) of the Presbyterian Church of Ghana, Monninger Congregation, Akosombo, led by its President Brother Stephen Addo and Fellowship Coordinator Mr Moses Teye Tetteh...',
                'content' => 'The Young Adults\' Fellowship (YAF) of the Presbyterian Church of Ghana, Monninger Congregation, Akosombo, led by its President Brother Stephen Addo and Fellowship Coordinator Mr Moses Teye Tetteh, District Minister and Resident Minister, Rev George Kwabi visited VRA Presby School to present stationery to final-year students.',
                'image' => 'https://img.youtube.com/vi/default/maxresdefault.jpg',
                'video_url' => 'https://web.facebook.com/DamcityTv/videos/995266299298362',
                'date' => 'May 26, 2025',
                'author' => 'YAF Coordinator',
                'category' => 'YAF OUTREACH'
            ],
            [
                'id' => 2,
                'title' => 'Ecumenical Visit to Akosombo Muslim Community',
                'slug' => 'ecumenical-visit-akosombo-muslim-community',
                'excerpt' => 'Our congregation participated in an ecumenical visit to the Akosombo Muslim Community, fostering interfaith dialogue and building bridges of understanding...',
                'content' => 'Our congregation participated in an ecumenical visit to the Akosombo Muslim Community, fostering interfaith dialogue and building bridges of understanding and peace in our community.',
                'image' => 'https://img.youtube.com/vi/default/maxresdefault.jpg',
                'video_url' => 'https://web.facebook.com/100070341725574/videos/2488763854790787',
                'date' => '2025',
                'author' => 'Church Secretary',
                'category' => 'ECUMENICAL'
            ],
            [
                'id' => 3,
                'title' => 'Unlocking Ewe Culture Through Food',
                'slug' => 'unlocking-ewe-culture-through-food',
                'excerpt' => 'Experience the rich traditions of Ewe culture through our celebration of Ghanaian delights. Discover the heritage and flavors that make our cultural celebrations special.',
                'content' => 'Experience the rich traditions of Ewe culture through our celebration of Ghanaian delights. Discover the heritage and flavors that make our cultural celebrations special.',
                'image' => 'https://img.youtube.com/vi/qsg6vwHZcDE/maxresdefault.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=qsg6vwHZcDE',
                'date' => '2024',
                'author' => 'Cultural Committee',
                'category' => 'CULTURAL'
            ],
            [
                'id' => 4,
                'title' => '90% Score for COVID-19 Protocol Adherence',
                'slug' => 'covid-19-protocol-adherence',
                'excerpt' => 'Monninger Presby Church scored 90% at first service after the lifting of ban on churches. Damcity TV visited to fellowship and observe adherence to all government protocols...',
                'content' => 'Monninger Presby Church scored 90% at first service after the lifting of ban on churches. Damcity TV visited to fellowship and observe adherence to all government protocols. Kudos to Monninger Presby, Akosombo for outstanding performance!',
                'image' => 'https://img.youtube.com/vi/bbT06TR1tlA/maxresdefault.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=bbT06TR1tlA',
                'date' => '2020',
                'author' => 'Health & Safety Team',
                'category' => 'HEALTH & SAFETY'
            ],
        ];
    }
}
