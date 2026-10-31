<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    public function interGenerational()
    {
        // Get inter-generational ministries from database
        $ministries = Ministry::where('active', true)
            ->where('category', 'inter-generational')
            ->orderBy('featured', 'desc')
            ->orderBy('name')
            ->get();
        
        // Get generational ministries for the age groups section
        $generationalMinistries = Ministry::where('active', true)
            ->where('category', 'generational')
            ->get();
        
        // Custom order: Children's Ministry, Youth Ministry, Young Adults, Women's Fellowship, Men's Fellowship
        $order = [
            "Children's Service (CS)" => 1,
            "Junior Youth (JY)" => 2,
            "Young People’s Guild (YPG)" => 3,
            "Young Adult Fellowship (YAF)" => 4,
            "Women's Fellowship" => 5,
            "Men's Fellowship" => 6,
     
        ];
        
        $generationalMinistries = $generationalMinistries->sortBy(function($ministry) use ($order) {
            return $order[$ministry->name] ?? 999;
        })->values();
            
        return view('ministries.inter-generational', compact('ministries', 'generationalMinistries'));
    }

    public function generational()
    {
        // Get generational ministries from database
        $ministries = Ministry::where('active', true)
            ->where('category', 'generational')
            ->get();
        
        // Custom order: CS, JY, YPG, YAF, Women's Fellowship, Men's Fellowship
        $order = [
            "Children's Service (CS)" => 1,
            "Junior Youth (JY)" => 2,
            "Young People's Guild (YPG)" => 3,
            "Young Adult Fellowship (YAF)" => 4,
            "Women's Fellowship" => 5,
            "Men's Fellowship" => 6,
            "Senior Citizens Ministry" => 7,
        ];
        
        $ministries = $ministries->sortBy(function($ministry) use ($order) {
            return $order[$ministry->name] ?? 999; // Put unmatched items at the end
        })->values();
            
        return view('ministries.generational', compact('ministries'));
    }
    
    public function index()
    {
        // Get all active ministries
        $ministries = Ministry::where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('name')
            ->get();
            
        return view('ministries.index', compact('ministries'));
    }
    
    public function show($slug)
    {
        // Get single ministry by slug
        $ministry = Ministry::where('slug', $slug)
            ->where('active', true)
            ->with(['leaders' => fn ($q) => $q->active()])
            ->firstOrFail();

        return view('ministries.show', compact('ministry'));
    }
}
