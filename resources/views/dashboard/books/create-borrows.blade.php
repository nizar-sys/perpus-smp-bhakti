@extends('layouts.app')
@section('title', 'Tambah Data Peminjaman Buku')

@section('title-header', 'Tambah Data Peminjaman Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Data Buku</a></li>
    <li class="breadcrumb-item active">Tambah Data Peminjaman Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Peminjaman Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.borrow.store', $books->first()->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="peminjam_id" value="{{ Auth::user()->member->id }}">
                        <input type="hidden" name="buku_id" value="{{ $books->first()->id }}">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="buku_id">Judul Buku</label>
                                    <select class="form-control @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id" disabled>
                                        <option value="">---Judul Buku---</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}" @if (old('buku_id') == $book->id) selected @endif @selected(true)>
                                                {{ $book->judul_buku }}</option>
                                        @endforeach
                                    </select>

                                    @error('buku_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="tanggal_pinjam">Tanggal Pinjam Buku</label>
                                    <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam"
                                        placeholder="Tanggal Pinjam Buku" value="{{ old('tanggal_pinjam') }}" name="tanggal_pinjam">

                                    @error('tanggal_pinjam')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('books.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
