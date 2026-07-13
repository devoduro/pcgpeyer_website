<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the videos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = Video::published()->latest();
        
        if ($category) {
            $query->where('category', $category);
        }
        
        $videos = $query->paginate(12);
        $featuredVideos = Video::published()->featured()->take(3)->get();
        $categories = Video::select('category')->distinct()->whereNotNull('category')->pluck('category');
        
        return view('pages.videos', compact('videos', 'featuredVideos', 'categories', 'category'));
    }
    
    /**
     * Display the specified video.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::published()->findOrFail($id);
        $video->incrementViews();
        
        $relatedVideos = Video::published()
            ->where('id', '!=', $video->id)
            ->where(function($query) use ($video) {
                if ($video->category) {
                    $query->where('category', $video->category);
                }
            })
            ->take(4)
            ->get();
        
        return view('pages.video_detail', compact('video', 'relatedVideos'));
    }
}
