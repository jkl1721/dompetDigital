@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Masuk Aplikasi</div>

                <div class="card-body">
                    <form method="POST" id="formLogin" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Masukkan Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username Di Sini" required autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message == 'These credentials do not match our records.' ? 'Sepertinya Username/PIN Salah, Silahkan Cek Kembali!' : $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Masukkan Pin') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="PIN Di Sini" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 px-5">
                                <button type="button" id="btnSubmit" class="btn btn-primary w-100 br-25">
                                    {{ __('Masuk') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#btnSubmit').on("click", function(){
            Swal.fire({
                html: '<div class="spinner-border text-info" style="width: 5rem; height: 5rem;" role="status"><span class="visually-hidden">Loading...</span></div><br><br><h5>Loading...</h5>',
                showConfirmButton: false,
                showSpinner: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                onRender: function() {
                    $('.swal2-content').prepend(sweet_loader);
                }
            });
            document.getElementById('formLogin').submit();
        });
</script>
@endsection
