@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Jobs</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary">Create Job</a>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Picture</th>
                <th>Apply</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->description }}</td>
                    <td><img src="{{ asset('storage/' . $job->picture) }}" alt="{{ $job->title }}" width="50"></td>
                    <td>{{ $job->apply }}</td>
                    <td>
                        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
