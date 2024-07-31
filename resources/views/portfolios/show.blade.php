<x-app-web-layout>
    <div class="container mt-5">
        <h2>Your Portfolio</h2>

        @if ($portfolio)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    @if ($portfolio->profile_picture)
                        <img src="{{ Storage::url($portfolio->profile_picture) }}" alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Default Profile Picture" style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                    <p class="card-text">
                        <strong>Phone Number:</strong> {{ $portfolio->phone_number }}<br>
                        <strong>Address:</strong> {{ $portfolio->address }}<br>
                        <strong>Bio:</strong> {{ $portfolio->bio }}
                    </p>
                    <a href="{{ route('portfolio.edit') }}" class="btn btn-primary">Edit Portfolio</a>
                    <form action="{{ route('portfolio.destroy') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Portfolio</button>
                    </form>
                </div>
            </div>
        @else
            <p>No portfolio found. <a href="{{ route('portfolio.create') }}">Create a portfolio</a></p>
        @endif
    </div>
</x-app-web-layout>
