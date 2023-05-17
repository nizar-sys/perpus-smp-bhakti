@php
    $routeActive = Route::currentRouteName();
@endphp

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i class="fas fa-users text-warning"></i>
        <span class="nav-link-text">Users</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'books.index' ? 'active' : '' }}" href="{{ route('books.index') }}">
        <i class="fas fa-book text-dark"></i>
        <span class="nav-link-text">Data Buku</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'members.index' ? 'active' : '' }}" href="{{ route('members.index') }}">
        <i class="fas fa-users text-primary"></i>
        <span class="nav-link-text">Data Anggota</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'borrows.index' ? 'active' : '' }}" href="{{ route('borrows.index') }}">
        <i class="fas fa-book text-warning"></i>
        <span class="nav-link-text">Data Peminjaman Buku</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'returns.index' ? 'active' : '' }}" href="{{ route('returns.index') }}">
        <i class="fas fa-book text-danger"></i>
        <span class="nav-link-text">Data Pengembalian Buku</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'stocks.index' ? 'active' : '' }}" href="{{ route('stocks.index') }}">
        <i class="fas fa-book text-primary"></i>
        <span class="nav-link-text">Data SO Buku</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
        <i class="fas fa-user-tie text-success"></i>
        <span class="nav-link-text">Profile</span>
    </a>
</li>
