<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'cover_letter' => 'required|string',
        'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $resumePath = null;
    if ($request->hasFile('resume')) {
        $resumePath = $request->file('resume')->store('resumes', 'public');
    }

    Application::create([
        'job_posting_id' => $request->job_posting_id,
        'user_id' => Auth::id(),
        'cover_letter' => $request->cover_letter,
        'resume' => $resumePath,
    ]);

    return redirect()->route('job-postings.index')->with('status', 'Application Submitted Successfully');
}

}
