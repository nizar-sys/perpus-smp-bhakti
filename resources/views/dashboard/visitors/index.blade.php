@extends('layouts.app')
@section('title', 'Data Kunjungan')

@section('title-header', 'Data Kunjungan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Kunjungan</li>
@endsection

@section('action_btn')
    <button class="btn btn-default" data-toggle="modal" data-target="#modalFilter">Filter Data</button>
    <a class="btn btn-danger" href="{{ route('visitors.index', []) }}">Reset Filter Data</a>
@endsection

@section('content')
    <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filter Data Kunjungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="get">
                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date_from">Dari Tanggal</label>
                                    <input type="date" class="form-control @error('date_from') is-invalid @enderror"
                                        id="date_from" placeholder="Dari Tanggal" value="{{ old('date_from') }}"
                                        name="date_from">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date_to">Ke Tanggal</label>
                                    <input type="date" class="form-control @error('date_to') is-invalid @enderror"
                                        id="date_to" placeholder="Ke Tanggal" value="{{ old('date_to') }}" name="date_to">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" href="{{ route('visitors.index', []) }}">Reset Filter Data</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Kunjungan</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama pengunjung</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $visitor->anggota->nis }}</td>
                                        <td>{{ $visitor->anggota->nama_anggota }}</td>
                                        <td>{{ $visitor->tanggal }}</td>
                                        <td class="d-flex jutify-content-center">
                                            <form id="delete-form-{{ $visitor->id }}"
                                                action="{{ route('visitors.destroy', $visitor->id) }}" class="d-none"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{ $visitor->id }}')"
                                                class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
                // jangan export kolom aksi
                exportOptions: {
                    columns: [0, 1, 2, 3]
                },
            }, ],
        });


        function deleteForm(id) {
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
