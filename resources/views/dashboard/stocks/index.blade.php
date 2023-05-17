@extends('layouts.app')
@section('title', 'Data SO Buku')

@section('title-header', 'Data SO Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data SO Buku</li>
@endsection

@section('action_btn')
    <a href="{{route('stocks.create')}}" class="btn btn-default">Tambah Data</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data SO Buku</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah Saat Ini</th>
                                    <th>Jumlah SO</th>
                                    <th>Selisih Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stocks as $stock)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stock->buku->judul_buku }}</td>
                                        <td>{{ $stock->tanggal }}</td>
                                        <td>{{ $stock->keterangan }}</td>
                                        <td>{{ $stock->buku->jumlah_buku }}</td>
                                        <td>{{ $stock->jumlah_buku }}</td>
                                        <td>{{ $stock->selisihBuku }}</td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{route('stocks.edit', $stock->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete-form-{{ $stock->id }}" action="{{ route('stocks.destroy', $stock->id) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{$stock->id}}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada data</td>
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
                        columns: [0,1,2,3,4,5,6]
                    },
                }
            ],
        });

        function deleteForm(id){
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            })
        }
    </script>
@endsection
