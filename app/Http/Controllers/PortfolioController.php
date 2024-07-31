<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    // Show the user's portfolio
    public function show()
    {
        $portfolio = Auth::user()->portfolio;

        if (!$portfolio) {
            // Redirect to create page if no portfolio exists
            return redirect()->route('portfolio.create');
        }

        return view('portfolios.show', ['portfolio' => $portfolio]);
    }

    // Show the form to create a new portfolio
    public function create()
    {
        return view('portfolios.create');
    }

    // Store a newly created portfolio in storage
    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profilePicturePath = $request->file('profile_picture') 
            ? $request->file('profile_picture')->store('profile_pictures', 'public')
            : null;

        Portfolio::create([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'bio' => $request->bio,
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('portfolio.show')->with('status', 'Portfolio Created Successfully');
    }

    // Show the form to edit the user's portfolio
    public function edit()
    {
        $portfolio = Auth::user()->portfolio;

        if (!$portfolio) {
            // Redirect to create page if no portfolio exists
            return redirect()->route('portfolio.create');
        }

        return view('portfolios.edit', ['portfolio' => $portfolio]);
    }

    // Update the specified portfolio in storage
    public function update(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $portfolio = Auth::user()->portfolio;

        if (!$portfolio) {
            return redirect()->route('portfolio.create');
        }

        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($portfolio->profile_picture) {
                Storage::disk('public')->delete($portfolio->profile_picture);
            }

            $portfolio->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $portfolio->phone_number = $request->phone_number;
        $portfolio->address = $request->address;
        $portfolio->bio = $request->bio;

        $portfolio->save();

        return redirect()->route('portfolio.show')->with('status', 'Portfolio Updated Successfully');
    }

    // Remove the specified portfolio from storage
    public function destroy()
    {
        $portfolio = Auth::user()->portfolio;

        if ($portfolio) {
            // Delete the profile picture if it exists
            if ($portfolio->profile_picture) {
                Storage::disk('public')->delete($portfolio->profile_picture);
            }

            $portfolio->delete();
        }

        return redirect()->route('portfolio.show')->with('status', 'Portfolio Deleted Successfully');
    }
}
