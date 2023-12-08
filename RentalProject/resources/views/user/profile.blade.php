@extends('user.main')
@section('content')
<style>
    .card {
        background-color: rgba(255, 255, 255, 1);
        /* RGBA dengan tingkat transparansi 0.8 */
        border-radius: 10px;
        /* Tambahkan border-radius untuk memberikan sudut yang sedikit melengkung */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Tambahkan box-shadow untuk efek bayangan */
    }

    .card-header {
        background-color: rgba(0, 123, 255, 1);
        /* Ubah warna header card sesuai kebutuhan */
        color: white;
        /* Ubah warna teks header card sesuai kebutuhan */
        border-radius: 10px 10px 0 0;
        /* Terapkan border-radius hanya pada sudut atas card header */
    }

    .card-body {
        padding: 20px;
        /* Tambahkan padding pada card body */
    }
</style>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Profile</h2>
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a class="btn btn-primary mt-auto" href="{{ route('user.index') }}">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
