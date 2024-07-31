<x-app-web-layout>
    <div class="container mt-5">
        <h2>Create Your Portfolio</h2>

        <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" class="form-control">{{ old('bio') }}</textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create Portfolio</button>
        </form>
    </div>
</x-app-web-layout>
