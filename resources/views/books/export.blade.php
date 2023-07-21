<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Books (PDF)</title>
    <!-- Tambahkan stylesheet dengan Vanilla CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 75px;
            height: auto;
        }
    </style>
</head>

<body>
    <h2>List of Books</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Description</th>
                @if (auth()->user()->is_admin)
                    <th>Owner</th>
                @endif
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <img src="{{ public_path() . $book->image }}" alt="{{ $book->title }}">
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->description }}</td>
                    @if (auth()->user()->is_admin)
                        <td>{{ $book->owner->name }}</td>
                    @endif
                    <td>{{ $book->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
