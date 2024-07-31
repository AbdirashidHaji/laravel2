<x-app-web-layout>
    <div class="container mt-5">
        <h2>Job Applications</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">
            @foreach ($jobApplications as $jobApplication)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $jobApplication->jobPosting->title }}</h5>
                            <p class="card-text">
                                <strong>Submitted By:</strong> {{ $jobApplication->user->name }}<br>
                                <strong>Phone Number:</strong> {{ $jobApplication->phone_number }}<br>
                                <strong>LinkedIn Profile:</strong> <a href="{{ $jobApplication->linkedin_profile }}" target="_blank">{{ $jobApplication->linkedin_profile }}</a><br>
                                <strong>Submitted On:</strong> {{ $jobApplication->created_at->format('M d, Y') }}
                            </p>
                            <a href="{{ route('job-applications.show', $jobApplication->id) }}" class="btn btn-primary btn-sm">View Application</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-web-layout>
