<!-- resources/views/books/show.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    @include('components.navbar')

    <div class="container mt-5">
        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">Back</a>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ $book->image }}" class="img-fluid" alt="{{ $book->title }}">
            </div>
            <div class="col-md-8">
                <h2>{{ $book->title }}</h2>
                <p><strong>Category:</strong> {{ $book->category->name }}</p>
                <p><strong>Description:</strong> {{ $book->description }}</p>
                <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
                <p><strong>Owner:</strong> {{ $book->owner->name }}</p>
                <a href="{{ $book->file }}" class="btn btn-primary">Download</a>
                <div class="d-flex gap-2 mt-2">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ugUkbCBbrrR9PiG2nUMDMuXTT3FJrpoG8cS6kS8RjMVLHT2L67fDHk2Ug+1P2wI" crossorigin="anonymous"></script>
</body>

</html>
