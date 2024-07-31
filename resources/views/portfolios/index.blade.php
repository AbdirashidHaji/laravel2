<x-app-web-layout>
    <div class="container mt-5">
        <h2>Portfolios</h2>

        <div class="row">
            @foreach ($portfolios as $portfolio)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($portfolio->profile_picture)
                            <img src="{{ Storage::url($portfolio->profile_picture) }}" alt="Profile Picture" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/400x300" alt="Default Profile Picture" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $portfolio->user->name }}</h5>
                            <p class="card-text">
                                <strong>Phone Number:</strong> {{ $portfolio->phone_number }}<br>
                                <strong>Address:</strong> {{ $portfolio->address }}<br>
                                <strong>Bio:</strong> {{ \Illuminate\Support\Str::limit($portfolio->bio, 100) }}
                            </p>
                            <a href="{{ route('portfolio.show', $portfolio->id) }}" class="btn btn-primary">View Portfolio</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-web-layout>
