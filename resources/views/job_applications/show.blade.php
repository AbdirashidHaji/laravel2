<x-app-web-layout>
    <div class="container mt-5">
        <h2>Application Details for {{ $jobApplication->jobPosting->title }}</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Submitted By: {{ $jobApplication->user->name }}</h5>
                <p class="card-text">
                    <strong>Phone Number:</strong> {{ $jobApplication->phone_number }}<br>
                    <strong>LinkedIn Profile:</strong> <a href="{{ $jobApplication->linkedin_profile }}" target="_blank">{{ $jobApplication->linkedin_profile }}</a><br>
                    <strong>Additional Information:</strong> {{ $jobApplication->additional_info }}<br>
                    <strong>Submitted On:</strong> {{ $jobApplication->created_at->format('M d, Y') }}
                </p>
                <div class="mt-3">
                    <strong>Resume:</strong>
                    <a href="{{ asset('uploads/resumes/' . basename($jobApplication->resume)) }}" download>Download Resume</a><br>
                    @if($jobApplication->cover_letter)
                        <strong>Cover Letter:</strong>
                        <a href="{{ asset('uploads/cover_letters/' . basename($jobApplication->cover_letter)) }}" download>Download Cover Letter</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Delete Button -->
        <form action="{{ route('job-applications.destroy', $jobApplication->id) }}" method="POST" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Application</button>
        </form>
    </div>
</x-app-web-layout>
