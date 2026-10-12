<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'photo_url' => 'nullable|url|max:2048',
            'about_me' => 'required|string|max:5000',
            'education' => 'nullable|string|max:5000',
            'skills' => 'nullable|string|max:5000',
            'projects' => 'nullable|string|max:5000',
            'work_experience' => 'nullable|string|max:5000',
            'social_links' => 'nullable|string|max:5000',
            'template' => 'required|in:simple,modern,creative',
        ]);

        return view('portfolio.preview', [
            'portfolio' => $validated,
        ]);
    }
}
