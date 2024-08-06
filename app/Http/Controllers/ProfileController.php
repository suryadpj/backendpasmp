<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show($slug)
    {
        // Fetch the page using the slug
        $page = Profile::where('slug', $slug)->firstOrFail();

        // Return the view with the page data
        return view('layout2', compact('page'));
    }

    public function show2($slug)
    {
        // Fetch the page using the slug
        $page = Profile::where('slug', $slug)->firstOrFail();

        // Return the view with the page data
        return view('layout1', compact('page'));
    }
}
