@extends('layouts.app')
@section('title', 'Dashboard')
@php
    $auth = Auth::user();
@endphp

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></li>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <a class="col-lg-4 col-md-6 col-12 text-dark" href="{{ route('users.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengguna</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $countData['users'] }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fas fa-users text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="col-lg-4 col-md-6 col-12 text-dark" href="{{ route('members.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Anggota</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $countData['members'] }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="col-lg-4 col-md-6 col-12 text-dark" href="{{ route('books.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Buku</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $countData['books'] }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @if (Auth::user()->role == 'pengunjung' && !Auth::user()->member->isVisited)
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0 text-dark">
                        <h5 class="mb-0">Formulir Tambah Data Kunjungan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('visitors.store') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nis">NIS Anggota</label>
                                        <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                            id="nis" placeholder="NIS Anggota" value="{{ old('nis') }}"
                                            name="nis">

                                        @error('nis')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tanggal">Tanggal Kunjungan</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" placeholder="Tanggal Kunjungan" value="{{ old('tanggal') }}"
                                            name="tanggal">

                                        @error('tanggal')
                                            <div class="d-block invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
