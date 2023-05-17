@extends('layouts.app')
@section('title', 'Ubah Data SO Buku')

@section('title-header', 'Ubah Data SO Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">Data SO Buku</a></li>
    <li class="breadcrumb-item active">Ubah Data SO Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Ubah Data SO Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks.update', $stock->id) }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="buku_id">Judul Buku</label>
                                    <select class="form-control @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id">
                                        <option value="" selected>---Judul Buku---</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}" @if (old('buku_id', $stock->buku_id) == $book->id) selected @endif>
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
                                    <label for="jumlah_buku">Jumlah SO Buku</label>
                                    <input type="text" class="form-control @error('jumlah_buku') is-invalid @enderror" id="jumlah_buku"
                                        placeholder="Jumlah SO Buku" value="{{ old('jumlah_buku', $stock->jumlah_buku) }}" name="jumlah_buku" max="{{ $stock->jumlah_buku }}">

                                    @error('jumlah_buku')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="keterangan">Keterangan SO</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    placeholder="Keterangan SO" name="keterangan" cols="30" rows="10">{{ old('keterangan', $stock->keterangan) }}</textarea>

                                    @error('keterangan')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                <a href="{{route('stocks.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
