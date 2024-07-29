<x-app-web-layout>

    <div class="container mt-5">
        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
        <a href="{{ url('job-postings') }}" class="btn btn-primary mx-1">Back to List</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Create New Job Posting</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('job-postings') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="salary">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" step="0.01" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="image">Image URL</label>
                                <input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}">
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Post Job</button>
                                <a href="{{ url('job-postings') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-web-layout>
