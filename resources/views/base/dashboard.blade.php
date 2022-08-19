@extends('layouts.app')
@section('title')
Dompet Digital Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <button id="btnTambahTransaksi" class="btn btn-primary mb-5 w-100 br-25">Tambahkan Transaksi Baru</button>
            <h2 class="text-success">Saldo Bapak : Rp. {{ number_format(Auth::user()->wallet, 0, ',', '.') }}</h2>
            <br>
            <div class="row">
                <div class="col-12 col-md-6">
                    Pemasukan 1 Tahun Terakhir
                </div>
                <div class="col-12 col-md-6">
                    Pengeluaran 1 Tahun Terakhir
                </div>
            </div>
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    $('#btnTambahTransaksi').on('click', function(e){
        Swal.fire({
            title: 'Tambah Transaksi Baru',
            icon: 'info',
            html: `
            <div class="p-0 m-0">
                <form id="formTambahTransaksi" method="POST" enctype="multipart/form-data">
                    <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Pilih Tanggal" value="{{ date("Y-m-d") }}">
                    <br>
                    <input type="hidden" id="jenisTransaksi" name="jenisTransaksi" value="1">
                    <button type="button" class="btn br-25 swal2-input btn-success" id="btnPemasukan">Pemasukan</button>
                    <button type="button" class="btn br-25 swal2-input btn-danger" id="btnPengeluaran">Pengeluaran</button>
                    <br><br>
                    <select id="kategori" name="kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{$item->id_kategori}}">{{$item->nama_kategori}}</option>
                        @endforeach
                    </select>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" id="nominal" name="nominal"  class="form-control" placeholder="Masukkan Jumlah Harga Transaksi Tanpa Tanda . atau ,">
                    </div>
                    <br>
                    <input type="text" id="keterangan" name="keterangan"  class="form-control" placeholder="Masukkan Keterangan">
                </form>
            </div>`,
            confirmButtonText: 'Tambah',
            focusConfirm: false,
            buttonsStyling: false,
            customClass: {
                confirmButton: "btn btn-primary br-25 w-100",
                cancelButton: "btn btn-danger"
            },
            preConfirm: () => {
                const tanggal = Swal.getPopup().querySelector('#tanggal').value
                const kategori = Swal.getPopup().querySelector('#kategori').value
                const nominal = Swal.getPopup().querySelector('#nominal').value
                if (!tanggal || !kategori || !nominal) {
                    Swal.showValidationMessage(`Periksa data yang bapak masukkan, sepertinya ada yang keliru.`)
                }
                return { tanggal: tanggal, kategori: kategori, nominal: nominal }
            }
        }).then((result) => {
            var tanggal = result.value.tanggal
            var kategori = result.value.kategori
            var nominal = result.value.nominal
            var keterangan = result.value.keterangan
            if(tanggal != null || kategori != '' || nominal != null){
                var formData = new FormData(document.getElementById('formTambahTransaksi'));
                Swal.fire({
                    html: '<div class="spinner-border text-info" style="width: 5rem; height: 5rem;" role="status"><span class="visually-hidden">Loading...</span></div><br><br><h5>Sedang Memproses Data, Tunggu Sebentar...</h5>',
                    showConfirmButton: false,
                    showSpinner: true,
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onRender: function() {
                        $('.swal2-content').prepend(sweet_loader);
                    }
                });
                $.ajax({
                    url: "{{ route('tambahTransaksi') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType : false,
                    success: function(data){
                        if(data.status){
                            Swal.fire({
                                text: "Data transaksi berhasil ditambahkan",
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
                            swal.close();
                            Swal.fire({
                                text: "Transaksi gagal di tambahkan, coba lagi",
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
    });

    $('#btnPemasukan').on('click', function(e){
        $('#jenisTransaksi').val('1')
        $("#btnPemasukan").addClass("btn-success");
        $("#btnPengeluaran").removeClass("btn-danger");
    });
    $('#btnPengeluaran').on('click', function(e){
        $('#jenisTransaksi').val('2')
        $("#btnPemasukan").removeClass("btn-success");
        $("#btnPengeluaran").addClass("btn-danger");
    });
</script>
@endsection
