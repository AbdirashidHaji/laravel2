<x-app-web-layout>

    <div class="container mt-5">
        <h1>{{ $jobPosting->title }}</h1>
        <p>{{ $jobPosting->description }}</p>
        <p><strong>Location:</strong> {{ $jobPosting->location }}</p>
        <p><strong>Salary:</strong> ${{ $jobPosting->salary }}</p>

        @auth
            <div class="mt-4">
                <h4>Apply for this job</h4>
                <form action="{{ route('applications.store', $jobPosting) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="cover_letter">Cover Letter</label>
                        <textarea class="form-control" id="cover_letter" name="cover_letter" rows="4" required></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="resume">Resume (PDF, DOC, DOCX)</label>
                        <input type="file" class="form-control" id="resume" name="resume">
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>

                </form>
            </div>
        @else
            <p><a href="{{ route('login') }}">Login</a> to apply for this job.</p>
        @endauth
    </div>

</x-app-web-layout>
