<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateBorrow;
use App\Models\Anggota;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows = Borrow::orderByDesc('id')->get();

        return view('dashboard.borrows.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::whereAvailable('y')->orderByDesc('id')->get();
        $members = Anggota::orderByDesc('id')->get();

        return view('dashboard.borrows.create', compact('books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateBorrow $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
            'tanggal_wajib_kembali' => Carbon::parse($request->tanggal_pinjam)->addDays(7),
        ];

        $borrow = Borrow::create($validated);

        // update jumlah_buku
        $book = Book::findOrFail($request->buku_id);

        $book->update([
            'jumlah_buku' => $book->jumlah_buku - 1,
        ]);

        return redirect(route('borrows.index'))->with('success', 'Data peminjaman buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Borrow::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $borrow = Borrow::findOrFail($id);
        $books = Book::whereAvailable('y')->orderByDesc('id')->get();
        $members = Anggota::orderByDesc('id')->get();

        return view('dashboard.borrows.edit', compact('borrow', 'books', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateBorrow $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
            'tanggal_wajib_kembali' => Carbon::parse($request->tanggal_pinjam)->addDays(7),
        ];

        $borrow = Borrow::findOrFail($id);

        $borrow->update($validated);

        return redirect(route('borrows.index'))->with('success', 'Data peminjaman buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->delete();

        return redirect(route('borrows.index'))->with('success', 'Data peminjaman buku berhasil dihapus.');
    }

    public function returnBook($borrowId)
    {
        $borrowDetail = Borrow::findOrFail($borrowId);

        $tanggalKembali = date('Y-m-d');

        // Menghitung selisih hari antara tanggal wajib kembali dan tanggal sekarang
        $selisihHari = strtotime($tanggalKembali) - strtotime($borrowDetail->tanggal_wajib_kembali);
        $telatHari = floor($selisihHari / (60 * 60 * 24));

        $denda = 500 * $telatHari;

        $payloadPengembalianBuku = [
            'borrow_id' => $borrowDetail->id,
            'petugas_id' => auth()->user()->id,
            'tanggal_kembali' => $tanggalKembali,
            'denda' => $denda,
            'jumlah_denda' => $denda,
            'created_at' => now(),
        ];
        $borrowDetail->update([
            'status' => 'dikembalikan',
        ]);

        $borrowDetail->pengembalian()->create($payloadPengembalianBuku);

        // update jumlah_buku
        $book = Book::findOrFail($borrowDetail->buku_id);

        $book->update([
            'jumlah_buku' => $book->jumlah_buku + 1,
        ]);

        return redirect(route('returns.index'))->with('success', 'Buku berhasil dikembalikan.');
    }
}
