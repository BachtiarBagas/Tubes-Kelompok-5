<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        confirmDelete();
        
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
        ]);

        Book::create($request->only(['title', 'author', 'year', 'description']));

        Alert::success('Added Successfully', 'Data Buku Berhasil Ditambahkan.');

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
        ]);

        // Ambil hanya data yang relevan
        $book->update($request->only(['title', 'author', 'year', 'description']));

        Alert::success('Changed Successfully', 'Data Buku Berhasil Diubah.');

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        Alert::success('Deleted Successfully', 'Buku Berhasil Dihapus.');

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function getData(Request $request)
    {
        $book= Book::with('title');

        if ($request->ajax()) {
            return datatables()->of($book)
                ->addIndexColumn()
                ->addColumn('index', function ($book) {
                    return view('books.index', compact('book'));
                })
                ->toJson();
        }
    }
}
