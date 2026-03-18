<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::all();
        return response()->view('cms.book.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('cms.book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:40',
            'page_number' => 'required|min:0',
            'price' => 'required|min:0|max:200',
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->page_number = $request->input('page_number');
        $book->price = $request->input('price');
        $book->save();
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        dd('Show Book');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return response()->view('cms.book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|min:3|max:40',
            'page_number' => 'required|min:0',
            'price' => 'required|min:0|max:200',
        ]);

        $book->title = $request->input('title');
        $book->page_number = $request->input('page_number');
        $book->price = $request->input('price');
        $isSaved = $book->save();
        session()->flash('message', $isSaved ? 'Book Updated' : 'Book Updated Failed');
        session()->flash('alert-type', $isSaved ? 'alert-success' : 'alert-danger');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $isDeleted =  $book->delete();
        return response()->json(
            [
                'icon' => $isDeleted ? 'success' : 'error',
                'title' => $isDeleted ? 'Deleted Successfully' : 'Deleted Failed',
            ],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
