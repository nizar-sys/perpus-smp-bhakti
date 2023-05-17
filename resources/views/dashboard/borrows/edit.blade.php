@extends('layouts.app')
@section('title', 'Ubah Data Peminjaman Buku')

@section('title-header', 'Ubah Data Peminjaman Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('borrows.index') }}">Data Peminjaman Buku</a></li>
    <li class="breadcrumb-item active">Ubah Data Peminjaman Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Ubah Data Peminjaman Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('borrows.update', $borrow->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="buku_id">Judul Buku</label>
                                    <select class="form-control @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id">
                                        <option value="" selected>---Judul Buku---</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}" @if (old('buku_id', $borrow->buku_id) == $book->id) selected @endif>
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
                                    <label for="peminjam_id">Peminjam Buku</label>
                                    <select class="form-control @error('peminjam_id') is-invalid @enderror" id="peminjam_id" name="peminjam_id">
                                        <option value="" selected>---Peminjam Buku---</option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}" @if (old('peminjam_id', $borrow->peminjam_id) == $member->id) selected @endif>
                                                {{ $member->nama_anggota }}</option>
                                        @endforeach
                                    </select>

                                    @error('peminjam_id')
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
                                        placeholder="Tanggal Pinjam Buku" value="{{ old('tanggal_pinjam', $borrow->tanggal_pinjam) }}" name="tanggal_pinjam">

                                    @error('tanggal_pinjam')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                <a href="{{route('borrows.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
