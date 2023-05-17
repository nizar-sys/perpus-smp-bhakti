@extends('layouts.app')
@section('title', 'Data Pengembalian Buku')

@section('title-header', 'Data Pengembalian Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pengembalian Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Pengembalian Buku</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Peminjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Denda</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($returns as $return)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $return->peminjaman->buku->judul_buku }}</td>
                                        <td>{{ $return->peminjaman->peminjam->nama_anggota }}</td>
                                        <td>{{ $return->peminjaman->tanggal_pinjam }}</td>
                                        <td>{{ $return->tanggal_kembali }}</td>
                                        <td>{{ $return->jumlah_denda_formated }}</td>
                                        <td>{{ $return->petugas->name }}</td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{ route('returns.edit', $return->id) }}"
                                                class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
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
            buttons: [{
                extend: 'pdf',
                className: 'btn btn-danger btn-sm',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                },
            }, ],
        });
    </script>
@endsection
