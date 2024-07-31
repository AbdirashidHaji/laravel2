<x-app-web-layout>
    <div class="container mt-5">
        <h2>Apply for {{ $jobPosting->title }}</h2>
        <form action="{{ route('applications.store', $jobPosting) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="resume">Resume</label>
                <input type="file" class="form-control" id="resume" name="resume" required>
            </div>
            <div class="form-group">
                <label for="cover_letter">Cover Letter</label>
                <input type="file" class="form-control" id="cover_letter" name="cover_letter">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="linkedin_profile">LinkedIn Profile</label>
                <input type="url" class="form-control" id="linkedin_profile" name="linkedin_profile">
            </div>
            <div class="form-group">
                <label for="additional_info">Additional Information</label>
                <textarea class="form-control" id="additional_info" name="additional_info" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>
</x-app-web-layout>
