@extends('layouts.app')
@section('title', 'Ubah Pengembalian Data Buku')

@section('title-header', 'Ubah Pengembalian Data Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('returns.index') }}">Pengembalian Data Buku</a></li>
    <li class="breadcrumb-item active">Ubah Pengembalian Data Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Ubah Pengembalian Data Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('returns.update', $return->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="judul_buku">Judul Buku</label>
                                    <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" id="judul_buku"
                                        placeholder="Judul Buku" value="{{ old('judul_buku', $return->peminjaman->buku->judul_buku) }}" name="judul_buku" disabled>

                                    @error('judul_buku')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="nama_anggota">Peminjam</label>
                                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" id="nama_anggota"
                                        placeholder="Peminjam" value="{{ old('nama_anggota', $return->peminjaman->peminjam->nama_anggota) }}" name="nama_anggota" disabled>

                                    @error('nama_anggota')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                    <input type="text" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam"
                                        placeholder="Tanggal Pinjam" value="{{ old('tanggal_pinjam', $return->peminjaman->tanggal_pinjam) }}" name="tanggal_pinjam" disabled>

                                    @error('tanggal_pinjam')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="tanggal_kembali">Tanggal Kembali</label>
                                    <input type="text" class="form-control @error('tanggal_kembali') is-invalid @enderror" id="tanggal_kembali"
                                        placeholder="Tanggal Kembali" value="{{ old('tanggal_kembali', $return->tanggal_kembali) }}" name="tanggal_kembali" disabled>

                                    @error('tanggal_kembali')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="jumlah_denda">Denda</label>
                                    <input type="number" class="form-control @error('jumlah_denda') is-invalid @enderror" id="jumlah_denda"
                                        placeholder="Denda" value="{{ old('jumlah_denda', $return->jumlah_denda) }}" name="jumlah_denda">

                                    @error('jumlah_denda')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                <a href="{{route('returns.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
