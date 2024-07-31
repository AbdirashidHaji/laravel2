<?php
namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function create(JobPosting $jobPosting)
    {
        return view('job_applications.create', ['jobPosting' => $jobPosting]);
    }

    public function store(Request $request, JobPosting $jobPosting)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'phone_number' => 'required|string|max:15',
            'linkedin_profile' => 'nullable|url|max:255',
            'additional_info' => 'nullable|string|max:1000',
        ]);

        $resumePath = $request->file('resume')->store('uploads/resumes', 'public');
        $coverLetterPath = $request->file('cover_letter') ? $request->file('cover_letter')->store('uploads/cover_letters', 'public') : null;

        JobApplication::create([
            'job_posting_id' => $jobPosting->id,
            'user_id' => Auth::id(),
            'resume' => $resumePath,
            'cover_letter' => $coverLetterPath,
            'phone_number' => $request->phone_number,
            'linkedin_profile' => $request->linkedin_profile,
            'additional_info' => $request->additional_info,
        ]);

        return redirect()->route('job-postings.index')->with('status', 'Job Application Submitted Successfully');
    }

    public function index()
    {
        $jobApplications = JobApplication::with('jobPosting', 'user')->get();
        return view('job_applications.index', ['jobApplications' => $jobApplications]);
    }

    public function show(JobApplication $jobApplication)
    {
        return view('job_applications.show', ['jobApplication' => $jobApplication]);
    }

    public function destroy(JobApplication $jobApplication)
    {
        // Delete files if they exist
        if ($jobApplication->resume && Storage::exists($jobApplication->resume)) {
            Storage::delete($jobApplication->resume);
        }

        if ($jobApplication->cover_letter && Storage::exists($jobApplication->cover_letter)) {
            Storage::delete($jobApplication->cover_letter);
        }

        $jobApplication->delete();

        return redirect()->route('job-applications.index')->with('status', 'Job Application Deleted Successfully');
    }
}
