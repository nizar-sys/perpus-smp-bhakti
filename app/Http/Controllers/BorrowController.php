<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateBorrow;
use App\Models\Anggota;
use App\Models\Book;
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
        $books = Book::orderByDesc('id')->get();
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
        ];

        $borrow = Borrow::create($validated);

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
        $books = Book::orderByDesc('id')->get();
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

        $payloadPengembalianBuku = [
            'borrow_id' => $borrowDetail->id,
            'petugas_id' => auth()->user()->id,
            'tanggal_kembali' => date('Y-m-d'),
            'denda' => 0,
            'jumlah_denda' => 0,
            'created_at' => now(),
        ];

        // hitung jumlah denda dari tanggal pinjam jika lebih dari 5 hari dari tanggal sekarang
        $tanggalPinjam = strtotime($borrowDetail->tanggal_pinjam);
        $tanggalSekarang = strtotime(date('Y-m-d'));

        $selisihHari = ($tanggalSekarang - $tanggalPinjam) / (60 * 60 * 24);

        if ($selisihHari > 5) {
            $payloadPengembalianBuku['denda'] = 1000;
            $payloadPengembalianBuku['jumlah_denda'] = ($selisihHari - 5) * 1000;
        }

        // update status peminjaman buku menjadi kembali
        $borrowDetail->update([
            'status' => 'dikembalikan',
        ]);

        $borrowDetail->pengembalian()->create($payloadPengembalianBuku);

        return redirect(route('returns.index'))->with('success', 'Buku berhasil dikembalikan.');
    }
}
