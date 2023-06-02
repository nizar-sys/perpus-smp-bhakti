<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Http\Requests\RequestBookCategory;
use Illuminate\Support\Facades\Hash;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BookCategory::orderByDesc('id')->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestBookCategory $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $category = BookCategory::create($validated);

        return redirect(route('categories.index'))->with('success', 'Data kategori buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return BookCategory::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = BookCategory::findOrFail($id);

        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestBookCategory $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $category = BookCategory::findOrFail($id);

        $category->update($validated);

        return redirect(route('categories.index'))->with('success', 'Data kategori buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = BookCategory::findOrFail($id);
        $category->delete();

        return redirect(route('categories.index'))->with('success', 'Data kategori buku berhasil dihapus.');
    }
}
