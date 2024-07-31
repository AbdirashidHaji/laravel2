<x-app-web-layout>
    <div class="container mt-5">
        <h2>Edit Your Portfolio</h2>

        <form action="{{ route('portfolio.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $portfolio->phone_number) }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $portfolio->address) }}">
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" class="form-control">{{ old('bio', $portfolio->bio) }}</textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                @if ($portfolio->profile_picture)
                    <img src="{{ Storage::url($portfolio->profile_picture) }}" alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Portfolio</button>
        </form>
    </div>
</x-app-web-layout>
