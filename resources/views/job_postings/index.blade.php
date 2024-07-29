<!-- resources/views/job_postings/index.blade.php -->

<x-app-web-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
                <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
                <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
            </div>
            <a href="{{ url('job-postings/create') }}" class="btn btn-primary">Post New Job</a>
        </div>
    </div>

    <div class="container mt-2">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">
            @foreach ($jobPostings as $jobPosting)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="{{ $jobPosting->image ?? 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                         class="card-img-top" 
                         alt="{{ $jobPosting->title }}" 
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $jobPosting->title }}</h5>
                        <p class="card-text">
                            <strong>Description:</strong> {{ \Illuminate\Support\Str::limit($jobPosting->description, 80) }}<br>
                            <strong>Location:</strong> {{ $jobPosting->location }}<br>
                            <strong>Salary:</strong> ${{ number_format($jobPosting->salary, 2) }}<br>
                            <strong>Posted By:</strong> {{ $jobPosting->user->name }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('job-postings/'.$jobPosting->id.'/edit') }}" class="btn btn-success btn-sm">Edit</a>
                            <form action="{{ url('job-postings/'.$jobPosting->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @auth
                            <form action="{{ route('applications.store', $jobPosting) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="job_posting_id" value="{{ $jobPosting->id }}">
                                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login to Apply</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-app-web-layout>
