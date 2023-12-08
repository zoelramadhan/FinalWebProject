@extends('layouts.app')

@section('content')
<style>
    .card {
        background-color: rgba(255, 255, 255, 0.8); /* RGBA dengan tingkat transparansi 0.8 */
        border-radius: 10px; /* Tambahkan border-radius untuk memberikan sudut yang sedikit melengkung */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Tambahkan box-shadow untuk efek bayangan */
        margin-top: 100px;
    }

    .card-header {
        background-color: rgba(0, 123, 255, 0.8); /* Ubah warna header card sesuai kebutuhan */
        color: white; /* Ubah warna teks header card sesuai kebutuhan */
        border-radius: 10px 10px 0 0; /* Terapkan border-radius hanya pada sudut atas card header */
    }

    .card-body {
        padding: 20px; /* Tambahkan padding pada card body */
    }
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6 d-flex">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    <!-- Tambahkan ikon mata untuk password -->
                                    <div class="input-group-append" >
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="font-size:10px; margin-left:5px">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6 d-flex">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    <!-- Tambahkan ikon mata untuk password -->
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword" style="font-size:10px; margin-left:5px">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('sign in') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Toggle untuk menampilkan/menyembunyikan password
        document.getElementById("togglePassword").addEventListener("click", function () {
            togglePassword("password");
            toggleEyeIcon("togglePassword");
        });

        // Toggle untuk menampilkan/menyembunyikan konfirmasi password
        document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
            togglePassword("password-confirm");
            toggleEyeIcon("toggleConfirmPassword");
        });

        function togglePassword(inputId) {
            var passwordInput = document.getElementById(inputId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        function toggleEyeIcon(buttonId) {
            var eyeIcon = document.querySelector("#" + buttonId + " i");
            eyeIcon.classList.toggle("fa-eye-slash");
        }
    </script>
@endsection
