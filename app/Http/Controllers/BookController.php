<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Auth;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::select('id', 'title', 'cover', 'description', 'user_id')
            ->paginate(10);
            return view('book.index', compact('books'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'desc' => 'required|string',
        ], [
            'title.required' => 'judul harus diisi.',
            'cover.required' => 'cover harus diunggah.',
            'cover.image' => 'File harus berupa gambar.',
            'cover.mimes' => 'gambar harus bertipe: jpeg, png, jpg.',
            'cover.max' => 'ukuran gambar tidak boleh lebih dari 2MB.',
            'desc.required' => 'Deskripsi harus diisi.',
            'desc.string' => 'Deskripsi harus berupa teks.',
        ]);

        try{
            $book = new Book;
            $book->title = $request->title;
            $book->cover = $request->file('cover')->store('book', 'public');
            $book->description = $request->desc;
            $book->user_id = \Auth::user()->id;
            $book->save();

            return redirect()->route('book.index')->with('success', 'Berhasil menambahkan data');
        } catch (\Throwable $th){
            return redirect()->route('book.index')->with('error', $th->getMessage());
        }
    }
}
