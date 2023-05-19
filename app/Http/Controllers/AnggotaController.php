<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateAnggota;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Anggota::orderByDesc('id')->get();

        return view('dashboard.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateAnggota $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $user = User::create([
            'name' => $validated['nama_anggota'],
            'username' => $request->username ?? strtolower(str($validated['nama_anggota'])->snake()),
            'password' => $request->password ?? Hash::make('password'),
            'created_at' => now(),
        ]);

        $user->member()->updateOrCreate([
            'user_id' => $user->id,
        ], $validated);

        return redirect(route('members.index'))->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Anggota::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Anggota::findOrFail($id);

        return view('dashboard.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateAnggota $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $member = Anggota::findOrFail($id);

        $member->update($validated);

        return redirect(route('members.index'))->with('success', 'Anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Anggota::findOrFail($id);
        $member->delete();

        return redirect(route('members.index'))->with('success', 'Anggota berhasil dihapus.');
    }

    public function printCard($memberId)
    {
        $member = Anggota::findOrFail($memberId);

        return view('dashboard.members.print', compact('member'));
    }
}
