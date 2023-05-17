@extends('layouts.app')
@section('title', 'Dashboard')
@php
    $auth = Auth::user();
@endphp

@section('breadcrumb')
<li class="breadcrumb-item active"><a
href="{{ route('home') }}">Dashboard</a></li>
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
@endsection
