<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Requests\RequestVisitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $visitors = Visitor::orderByDesc('id')
        ->when($request->date_form, function ($query) use ($request) {
            $query->whereDate('tanggal', '>=', $request->date_form);
        })
        ->when($request->date_to, function ($query) use ($request) {
            $query->whereDate('tanggal', '<=', $request->date_to);
        })
        ->when($request->date_from, function ($query) use ($request) {
            $query->when($request->date_to, function ($query) use ($request) {
                $query->whereBetween('tanggal', [$request->date_from, $request->date_to]);
            });
        })
        ->get();

        return view('dashboard.visitors.index', compact('visitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.visitors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestVisitor $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        if ($validated['nis'] != Auth::user()->member->nis) {
            return back()->with('error', 'NIS tidak sesuai dengan akun Anda.');
        }

        $validated['anggota_id'] = Auth::user()->member->id;

        $visitor = Visitor::create($validated);

        return back()->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Visitor::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitor = Visitor::findOrFail($id);

        return view('dashboard.visitors.edit', compact('visitor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestVisitor $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $visitor = Visitor::findOrFail($id);

        $visitor->update($validated);

        return redirect(route('visitors.index'))->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return redirect(route('visitors.index'))->with('success', 'Data absensi berhasil dihapus.');
    }
}
