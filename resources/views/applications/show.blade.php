<x-app-web-layout>

    <div class="container mt-5">
        <h1>Application Details</h1>

        <div class="card mt-3">
            <div class="card-header">
                <h4>Application for {{ $application->jobPosting->title }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Applicant:</strong> {{ $application->user->name }}</p>
                <p><strong>Cover Letter:</strong></p>
                <p>{{ $application->cover_letter }}</p>
                <p><strong>Resume:</strong></p>
                @if ($application->resume)
                    <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">View Resume</a>
                @else
                    No Resume
                @endif
            </div>
        </div>
    </div>

</x-app-web-layout>
