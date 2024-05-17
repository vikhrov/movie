

<!DOCTYPE html>
<html>
<head>
    <title>Create Movie</title>
</head>
<body>
    <h1>Create Movie</h1>
    <form action="{{ url('/movies') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="poster">Poster:</label>
            <input type="file" name="poster" id="poster">
        </div>
        <div>
            <label for="genres">Genres:</label>
            <select name="genres[]" id="genres" multiple required>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Add Movie</button>
    </form>
</body>
</html>
