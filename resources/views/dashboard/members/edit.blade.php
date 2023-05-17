@extends('layouts.app')
@section('title', 'Ubah Data Anggota')

@section('title-header', 'Ubah Data Anggota')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Data Anggota</a></li>
    <li class="breadcrumb-item active">Ubah Data Anggota</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Ubah Data Anggota</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('members.update', $member->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="nama_anggota">Nama Anggota</label>
                                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" id="nama_anggota"
                                        placeholder="Nama Anggota" value="{{ old('nama_anggota', $member->nama_anggota) }}" name="nama_anggota">

                                    @error('nama_anggota')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="no_telp">NO. Telp Anggota</label>
                                    <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                        placeholder="NO. Telp Anggota" value="{{ old('no_telp', $member->no_telp) }}" name="no_telp">

                                    @error('no_telp')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="tgl_lahir">Tanggal Lahir Anggota</label>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                                        placeholder="Tanggal Lahir Anggota" value="{{ old('tgl_lahir', $member->tgl_lahir) }}" name="tgl_lahir">

                                    @error('tgl_lahir')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat Anggota</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    placeholder="Alamat Anggota" name="alamat" cols="30" rows="10">{{ old('alamat', $member->alamat) }}</textarea>

                                    @error('alamat')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                <a href="{{route('books.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
