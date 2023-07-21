<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        body {
            padding-top: 60px;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
    </style>
</head>

<body>
    @include('components.navbar')

    <div class="container mt-4">
        <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary mb-3">Back</a>

        <h2 class="mb-3">Add Book</h2>
        <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $book->title) }}"
                    required autofocus>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror"
                    required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category', $book->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity"
                    class="form-control @error('quantity') is-invalid @enderror"
                    value="{{ old('quantity', $book->quantity) }}" required>
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="imageHelpblock" class="form-text">
                    If you want to change the image, please upload a new one.
                    If not, you can leave this field empty.
                </div>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File (Pdf)</label>
                <input type="file" name="file" id="file"
                    class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}">
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="fileHelpblock" class="form-text">
                    If you want to change the file, please upload a new one.
                    If not, you can leave this field empty.
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ugUkbCBbrrR9PiG2nUMDMuXTT3FJrpoG8cS6kS8RjMVLHT2L67fDHk2Ug+1P2wI" crossorigin="anonymous"></script>
</body>

</html>
