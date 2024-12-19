

<form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="image">Choose Image</label>
    <input type="file" id="image" name="image" required>
    <br>
    <button type="submit">Upload Photo</button>
</form>

