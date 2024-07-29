<?php

// app/Http/Controllers/JobPostingController.php
namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostingController extends Controller
{
    public function index()
    {
        $jobPostings = JobPosting::with('user')->get();
        return view('job_postings.index', ['jobPostings' => $jobPostings]);
    }

    public function create()
    {
        return view('job_postings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'image' => 'nullable|url',
        ]);

        JobPosting::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'image' => $request->image,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('job-postings.index')->with('status', 'Job Posting Created Successfully');
    }

    public function edit(JobPosting $jobPosting)
    {
        return view('job_postings.edit', ['jobPosting' => $jobPosting]);
    }

    public function update(Request $request, JobPosting $jobPosting)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'image' => 'nullable|url',
        ]);

        $jobPosting->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'image' => $request->image,
        ]);

        return redirect()->route('job-postings.index')->with('status', 'Job Posting Updated Successfully');
    }

    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();
        return redirect()->route('job-postings.index')->with('status', 'Job Posting Deleted Successfully');
    }
}
