

<form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ $photo->title }}" required>
    <br>
    <label for="image">Choose New Image (Optional)</label>
    <input type="file" id="image" name="image">
    <br>
    <button type="submit">Update Photo</button>
</form>
