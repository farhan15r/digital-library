<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library App</title>

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

        .book-row:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    @include('components.navbar')

    <div class="container mt-4">
        <h2 class="mb-3">List of Books</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('books.create') }}" class="btn btn-primary">Add new book</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="book-row" onclick="detailPage(event)" data-href="{{ route('books.show', $book->id) }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <img src="{{ $book->image }}" class="img-fluid" width="75em" alt="{{ $book->title }}">
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ substr($book->description, 0, 125) . '...' }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>
                            <a href="{{ $book->file }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ugUkbCBbrrR9PiG2nUMDMuXTT3FJrpoG8cS6kS8RjMVLHT2L67fDHk2Ug+1P2wI" crossorigin="anonymous"></script>

    <script>
        function detailPage(e) {
            const row = e.currentTarget;
            const href = row.dataset.href;

            window.location.href = href
        }
    </script>
</body>

</html>
