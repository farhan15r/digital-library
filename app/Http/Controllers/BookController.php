<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category_id = $request->query('category_id');

        $booksQuery = Book::query();

        if(!auth()->user()->is_admin) {
            $booksQuery->where('owner_id', auth()->user()->id);
        }
        if ($category_id) {
            $booksQuery->where('category_id', $category_id);
        }

        $books = $booksQuery->get();
        $categories = Category::all();

        $data = [
            'books' => $books,
            'categories' => $categories,
        ];

        return view('books.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        $data = [
            'categories' => $categories,
        ];

        return view('books.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'file' => 'required|mimes:pdf|max:10000',
            'image' => 'required|mimes:jpg,jpeg,png|max:10000',
        ]);

        $disk = Storage::build([
            'driver' => 'local',
            'root' => public_path(),
        ]);

        $file_name = Str::random(10) . '-' . str_replace(' ', '-', $request->title) . '.' . $request->file->getClientOriginalExtension();
        $image_name = Str::random(10) . '-' . str_replace(' ', '-', $request->title) . '.' . $request->image->getClientOriginalExtension();

        $file_path = '/uploads/books/' . $file_name;
        $image_path = '/uploads/images/' . $image_name;

        $disk->put($file_path, file_get_contents($request->file));
        $disk->put($image_path, file_get_contents($request->image));

        Book::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'file' => $file_path,
            'image' => $image_path,
            'owner_id' => auth()->user()->id,
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if (
            $book->owner_id != auth()->user()->id &&
            auth()->user()->is_admin == false
        ) {
            return redirect()->route('books.index')->with('error', 'You are not authorized to view this book');
        }

        $data = [
            'book' => $book,
        ];

        return view('books.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        if (
            $book->owner_id != auth()->user()->id &&
            auth()->user()->is_admin == false
        ) {
            return redirect()->route('books.index')->with('error', 'You are not authorized to view this book');
        }

        $categories = Category::all();

        $data = [
            'book' => $book,
            'categories' => $categories,
        ];

        return view('books.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'file' => 'mimes:pdf|max:10000',
            'image' => 'mimes:jpg,jpeg,png|max:10000',
        ]);

        $disk = Storage::build([
            'driver' => 'local',
            'root' => public_path(),
        ]);

        if ($request->file){
            if ($book->file != '/dummy/dummy.pdf') {
                $disk->delete($book->file);
            }

            $file_name = Str::random(10) . '-' . str_replace(' ', '-', $request->title) . '.' . $request->file->getClientOriginalExtension();
            $file_path = '/uploads/books/' . $file_name;
            $disk->put($file_path, file_get_contents($request->file));
        } else {
            $file_path = $book->file;
        }

        if ($request->image){
            if ($book->image != '/dummy/dummy.jpg') {
                $disk->delete($book->image);
            }

            $image_name = Str::random(10) . '-' . str_replace(' ', '-', $request->title) . '.' . $request->image->getClientOriginalExtension();
            $image_path = '/uploads/images/' . $image_name;
            $disk->put($image_path, file_get_contents($request->image));
        } else {
            $image_path = $book->image;
        }

        $book->update([
            'title' => $request->title,
            'category_id' => $request->category,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'file' => $file_path,
            'image' => $image_path,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $disk = Storage::build([
            'driver' => 'local',
            'root' => public_path(),
        ]);

        if ($book->file != '/dummy/dummy.pdf') {
            $disk->delete($book->file);
        }

        if ($book->image != '/dummy/dummy.jpg') {
            $disk->delete($book->image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
