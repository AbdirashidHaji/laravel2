<x-app-web-layout>

    <div class="container mt-5">
        <h1>Applications</h1>

        <div class="card mt-3">
            <div class="card-header">
                <h4>All Applications</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Job Title</th>
                            <th>Applicant</th>
                            <th>Cover Letter</th>
                            <th>Resume</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->id }}</td>
                            <td>{{ $application->jobPosting->title }}</td>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->cover_letter }}</td>
                            <td>
                                @if ($application->resume)
                                    <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">View Resume</a>
                                @else
                                    No Resume
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('applications.show', $application) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-web-layout>
