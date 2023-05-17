@extends('layouts.app')
@section('title', 'Tambah Data Buku')

@section('title-header', 'Tambah Data Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Data Buku</a></li>
    <li class="breadcrumb-item active">Tambah Data Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="judul_buku">Judul Buku</label>
                                    <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" id="judul_buku"
                                        placeholder="Judul Buku" value="{{ old('judul_buku') }}" name="judul_buku">

                                    @error('judul_buku')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="nama_pengarang">Pengarang Buku</label>
                                    <input type="text" class="form-control @error('nama_pengarang') is-invalid @enderror" id="nama_pengarang"
                                        placeholder="Pengarang Buku" value="{{ old('nama_pengarang') }}" name="nama_pengarang">

                                    @error('nama_pengarang')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="nama_penerbit">Penerbit Buku</label>
                                    <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror" id="nama_penerbit"
                                        placeholder="Penerbit Buku" value="{{ old('nama_penerbit') }}" name="nama_penerbit">

                                    @error('nama_penerbit')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="tahun_terbit">Tahun Terbit Buku</label>
                                    <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit"
                                        placeholder="Tahun Terbit Buku" value="{{ old('tahun_terbit') }}" name="tahun_terbit">

                                    @error('tahun_terbit')
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
