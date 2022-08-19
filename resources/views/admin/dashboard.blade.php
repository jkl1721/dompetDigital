@extends('layouts.app')
@section('title')
Dompet Digital Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Daftar Transaksi Bapak Yang Belum Di Approved') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 dtr-inline collapsed table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $item->id_transaksi }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td class="{{ $item->jenis_transaksis->nama_jenis == 'Pemasukan' ? 'text-success' : 'text-danger' }}">{{ $item->jenis_transaksis->nama_jenis }}</td>
                                    <td>{{ $item->kategoris->nama_kategori }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <button id="btnEdit" class="btn btn-sm btn-primary">Edit</button>
                                        <button id="btnApprove" class="btn btn-sm btn-success">Approve</button>
                                        <button id="btnHapus" onClick="hapusTransaksi('{{ $item->id_transaksi }}')" class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    @if (session('status'))
    <script>
        Swal.fire({
            text: "{{session('status')}}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Sip!",
            customClass: {
                confirmButton: "btn btn-primary btn-primarynew"
            }
        });
    </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire({
            text: "{{session('error')}}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Oke",
            customClass: {
                confirmButton: "btn btn-primary btn-primarynew"
            }
        });
    </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                responsive: {
                    details: {
                        type: 'column'
                    }
                },
                columnDefs: [ {
                    className: 'dtr-control',
                    orderable: false,
                    targets:   0
                } ],
                order: [ 1, 'asc' ]
            } );
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function hapusTransaksi(id){
            var id = id;
            Swal.fire({
                title: 'Hapus data transaksi ini?',
                text: "Transaksi ini akan dihapus?",
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-danger"
                },
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        html: '<div class="spinner-border text-info" style="width: 5rem; height: 5rem;" role="status"><span class="visually-hidden">Loading...</span></div><br><br><h5>Sedang Memproses Data...</h5>',
                        showConfirmButton: false,
                        showSpinner: true,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onRender: function() {
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                    $.ajax({
                        url: "{{ route('hapusTransaksi') }}",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(data){
                            swal.close();
                            if(data.status){
                                Swal.fire({
                                    text: "Data transaksi berhasil di hapus!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Sip!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then((result) => {
                                    if (result.value) {
                                        swal.close();
                                        window.location.reload();
                                    }
                                });
                            }else{
                                Swal.fire({
                                    text: "Data transaksi gagal di hapus!",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Oke!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        }
                    });
                }
            })
        }
    </script>
    @endsection
