@extends('layouts.app')
@section('title', 'Data Peminjaman Buku')

@section('title-header', 'Data Peminjaman Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Peminjaman Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Peminjaman Buku</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>NIS Peminjam</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Wajib Kembali</th>
                                    <th>Status</th>
                                    <th>Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrows as $borrow)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $borrow->buku->judul_buku }}</td>
                                        <td>{{ $borrow->peminjam->nis }}</td>
                                        <td>{{ $borrow->peminjam->nama_anggota }}</td>
                                        <td>{{ $borrow->tanggal_pinjam }}</td>
                                        <td>{{ $borrow->tanggal_wajib_kembali }}</td>
                                        <td>{{ $borrow->status_formated }}</td>
                                        <td>{{ $borrow->petugas->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
                var tablePengguna = $('#table-data').DataTable({
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari Data",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ data)",
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: "<i class='fa fa-angle-right'></i>",
                }
            },
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6, 7]
                    },
                },
            ],
        });
    </script>
@endsection
