<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function dashboard()
    {
        $countData = [
            'users' => User::count(),
            'members' => Anggota::count(),
            'books' => Book::count(),
        ];

        return view('dashboard.index', compact('countData'));
    }
}
