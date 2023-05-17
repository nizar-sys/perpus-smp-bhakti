<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateStockOpname;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class StockOpnameController extends Controller
{
    // protect controller
    public function __construct()
    {
        $this->middleware('roles:petugas')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = StockOpname::orderByDesc('id')->get();

        return view('dashboard.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::orderByDesc('id')->get();

        return view('dashboard.stocks.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateStockOpname $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $stock = StockOpname::create($validated);

        return redirect(route('stocks.index'))->with('success', 'Data SO buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return StockOpname::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = StockOpname::findOrFail($id);
        $books = Book::orderByDesc('id')->get();

        return view('dashboard.stocks.edit', compact('stock', 'books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateStockOpname $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $stock = StockOpname::findOrFail($id);

        $stock->update($validated);

        return redirect(route('stocks.index'))->with('success', 'Data SO buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = StockOpname::findOrFail($id);
        $stock->delete();

        return redirect(route('stocks.index'))->with('success', 'Data SO buku berhasil dihapus.');
    }
}
