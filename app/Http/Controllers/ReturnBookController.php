<?php

namespace App\Http\Controllers;

use App\Models\ReturnBook;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateReturnBook;
use Illuminate\Support\Facades\Hash;

class ReturnBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returns = ReturnBook::orderByDesc('id');
        $returns = $returns->paginate(50);

        return view('dashboard.returns.index', compact('returns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.returns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateReturnBook $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $return = ReturnBook::create($validated);

        return redirect(route('returns.index'))->with('success', 'Data pengembalian buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ReturnBook::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return = ReturnBook::findOrFail($id);

        return view('dashboard.returns.edit', compact('return'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->all() + [
            'updated_at' => now(),
        ];

        $return = ReturnBook::findOrFail($id);

        $return->update($validated);

        return redirect(route('returns.index'))->with('success', 'Data pengembalian buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = ReturnBook::findOrFail($id);
        $return->delete();

        return redirect(route('returns.index'))->with('success', 'Data pengembalian buku berhasil dihapus.');
    }
}
