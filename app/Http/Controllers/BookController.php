<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateBook;
use App\Models\BookCategory;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BookController extends Controller
{
    // protect controller
    public function __construct()
    {
        $this->middleware('roles:petugas')->except(['index', 'show', 'borrowBook', 'borrow', 'borrows']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderByDesc('id')->get();

        return view('dashboard.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BookCategory::orderByDesc('id')->get();
        return view('dashboard.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateBook $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $book = Book::create($validated);

        return redirect(route('books.index'))->with('success', 'Data buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = BookCategory::orderByDesc('id')->get();
        return view('dashboard.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateBook $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $book = Book::findOrFail($id);

        $book->update($validated);

        return redirect(route('books.index'))->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect(route('books.index'))->with('success', 'Data buku berhasil dihapus.');
    }

    public function borrowBook($bookId)
    {
        $books = Book::whereId($bookId)->get();

        return view('dashboard.books.create-borrows', compact('books'));
    }

    public function borrow(Request $request, $bookId)
    {
        $validated = $request->all() + [
            'created_at' => now(),
            'tanggal_wajib_kembali' => Carbon::parse($request->tanggal_pinjam)->addDays(7),
        ];

        $borrow = Borrow::create($validated);

        // update jumlah_buku

        $book = Book::findOrFail($bookId);

        $book->update([
            'jumlah_buku' => $book->jumlah_buku - 1,
        ]);

        return redirect(route('books.borrow.index'))->with('success', 'Data peminjaman buku berhasil ditambahkan.');
    }

    public function borrows()
    {
        $borrows = Borrow::wherePeminjamId(Auth::user()->member->id)->orderByDesc('id')->get();

        return view('dashboard.books.index-borrows', compact('borrows'));
    }
}
