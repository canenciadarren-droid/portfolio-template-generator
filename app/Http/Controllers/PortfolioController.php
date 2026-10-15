<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Display all saved portfolios.
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->get();

        return view('portfolio.index', [
            'portfolios' => $portfolios,
        ]);
    }

    /**
     * Save portfolio information and upload a profile picture.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'about_me' => 'required|string|max:5000',
            'education' => 'nullable|string|max:5000',
            'skills' => 'nullable|string|max:5000',
            'projects' => 'nullable|string|max:5000',
            'work_experience' => 'nullable|string|max:5000',
            'social_links' => 'nullable|string|max:5000',
            'photo' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ]);

        // Temporary default until the user selects a template.
        $validated['template'] = 'simple';

        // Upload the profile picture to Supabase Storage.
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $supabaseUrl = rtrim(
                (string) config('services.supabase.url'),
                '/'
            );

            $secretKey = (string) config('services.supabase.secret_key');

            if ($supabaseUrl === '' || $secretKey === '') {
                return back()
                    ->withErrors([
                        'photo' => 'Image storage is not configured.',
                    ])
                    ->withInput();
            }

            $extension = strtolower($file->extension());
            $path = 'profiles/' . Str::uuid() . '.' . $extension;
            $mimeType = $file->getMimeType();

            $response = Http::timeout(30)
                ->withHeaders([
                    'apikey' => $secretKey,
                    'Authorization' => 'Bearer ' . $secretKey,
                    'Content-Type' => $mimeType,
                    'x-upsert' => 'false',
                ])
                ->withBody(
                    file_get_contents($file->getRealPath()),
                    $mimeType
                )
                ->post(
                    $supabaseUrl .
                    '/storage/v1/object/portfolio-photos/' . $path
                );

            if ($response->failed()) {
                return back()
                    ->withErrors([
                        'photo' => 'Image upload failed. Check your Supabase Storage settings.',
                    ])
                    ->withInput();
            }

            $validated['photo_url'] = $supabaseUrl .
                '/storage/v1/object/public/portfolio-photos/' . $path;
        }

        // The uploaded file itself is not a database column.
        unset($validated['photo']);

        // Save the portfolio to Supabase PostgreSQL.
        $portfolio = Portfolio::create($validated);

        // Continue to template selection.
        return response('', 303)
            ->header(
                'Location',
                '/portfolio/' . $portfolio->id . '/templates'
            );
    }

    /**
     * Display a saved portfolio preview.
     */
    public function show(Portfolio $portfolio)
    {
        return view('portfolio.preview', [
            'portfolio' => $portfolio,
        ]);
    }

    /**
     * Display the three available templates.
     */
    public function selectTemplate(Portfolio $portfolio)
    {
        return view('portfolio.templates', [
            'portfolio' => $portfolio,
        ]);
    }

    /**
     * Save the selected template.
     */
    public function updateTemplate(
        Request $request,
        Portfolio $portfolio
    ) {
        $validated = $request->validate([
            'template' => 'required|in:simple,modern,creative',
        ]);

        $portfolio->update($validated);

        // Display the generated portfolio preview.
        return response('', 303)
            ->header(
                'Location',
                '/portfolio/' . $portfolio->id
            );
    }

    /**
     * Display the form for editing a saved portfolio.
     */
    public function edit(Portfolio $portfolio)
    {
        return view('portfolio.edit', [
            'portfolio' => $portfolio,
        ]);
    }

    /**
     * Update an existing portfolio.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'about_me' => 'required|string|max:5000',
            'education' => 'nullable|string|max:5000',
            'skills' => 'nullable|string|max:5000',
            'projects' => 'nullable|string|max:5000',
            'work_experience' => 'nullable|string|max:5000',
            'social_links' => 'nullable|string|max:5000',
            'photo' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ]);

        // Upload a replacement profile picture if provided.
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $supabaseUrl = rtrim(
                (string) config('services.supabase.url'),
                '/'
            );

            $secretKey = (string) config('services.supabase.secret_key');

            if ($supabaseUrl === '' || $secretKey === '') {
                return back()
                    ->withErrors([
                        'photo' => 'Image storage is not configured.',
                    ])
                    ->withInput();
            }

            $extension = strtolower($file->extension());
            $path = 'profiles/' . Str::uuid() . '.' . $extension;
            $mimeType = $file->getMimeType();

            $response = Http::timeout(30)
                ->withHeaders([
                    'apikey' => $secretKey,
                    'Authorization' => 'Bearer ' . $secretKey,
                    'Content-Type' => $mimeType,
                    'x-upsert' => 'false',
                ])
                ->withBody(
                    file_get_contents($file->getRealPath()),
                    $mimeType
                )
                ->post(
                    $supabaseUrl .
                    '/storage/v1/object/portfolio-photos/' . $path
                );

            if ($response->failed()) {
                return back()
                    ->withErrors([
                        'photo' => 'Image upload failed. Please try again.',
                    ])
                    ->withInput();
            }

            $validated['photo_url'] = $supabaseUrl .
                '/storage/v1/object/public/portfolio-photos/' . $path;
        }

        // Keep the existing image when no new image was uploaded.
        unset($validated['photo']);

        // Update the existing database record.
        $portfolio->update($validated);

        return response('', 303)
            ->header(
                'Location',
                '/portfolio/' . $portfolio->id
            );
    }

    /**
     * Delete a portfolio and attempt to remove its stored picture.
     */
    public function destroy(Portfolio $portfolio)
    {
        $this->deleteStoredPhoto($portfolio->photo_url);

        $portfolio->delete();

        return response('', 303)
            ->header('Location', '/portfolios');
    }

    /**
     * Remove a profile picture from this project's Storage bucket.
     */
    private function deleteStoredPhoto(?string $photoUrl): void
    {
        if (!$photoUrl) {
            return;
        }

        $supabaseUrl = rtrim(
            (string) config('services.supabase.url'),
            '/'
        );

        $secretKey = (string) config('services.supabase.secret_key');

        if ($supabaseUrl === '' || $secretKey === '') {
            return;
        }

        $photoHost = parse_url($photoUrl, PHP_URL_HOST);
        $supabaseHost = parse_url($supabaseUrl, PHP_URL_HOST);
        $photoPath = parse_url($photoUrl, PHP_URL_PATH);

        $prefix = '/storage/v1/object/public/portfolio-photos/';

        // Only delete files belonging to this project's bucket.
        if (
            !$photoHost ||
            $photoHost !== $supabaseHost ||
            !$photoPath ||
            !str_starts_with($photoPath, $prefix)
        ) {
            return;
        }

        $objectPath = substr($photoPath, strlen($prefix));

        if ($objectPath === '') {
            return;
        }

        try {
            Http::timeout(15)
                ->withHeaders([
                    'apikey' => $secretKey,
                    'Authorization' => 'Bearer ' . $secretKey,
                ])
                ->delete(
                    $supabaseUrl .
                    '/storage/v1/object/portfolio-photos/' . $objectPath
                );
        } catch (\Throwable $exception) {
            // A Storage failure should not prevent deleting the record.
            report($exception);
        }
    }
}
