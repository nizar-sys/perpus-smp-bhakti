<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreOrUpdateAnggota;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
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

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
