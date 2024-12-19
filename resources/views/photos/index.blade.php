

<!-- resources/views/photos/index.blade.php -->

@extends('layouts.app') <!-- Replace 'app' with your layout file name if different -->

@section('content')
    <h1>Photos Index Page</h1>

    <!-- Display photos here as needed -->
    <div class="photos-list">
        @foreach ($photos as $photo)
            <div class="photo">
                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}">
                <h2>{{ $photo->title }}</h2>
                <!-- Additional details or actions -->
            </div>
        @endforeach
    </div>
@endsection

