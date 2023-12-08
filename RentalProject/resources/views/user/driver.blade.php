@extends('user.main')
@section('content')
<style>
    .card {
        background-color: rgba(255, 255, 255, 0.8);
        /* RGBA dengan tingkat transparansi 0.8 */
        border-radius: 10px;
        /* Tambahkan border-radius untuk memberikan sudut yang sedikit melengkung */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Tambahkan box-shadow untuk efek bayangan */
    }

    .card-header {
        background-color: rgba(0, 123, 255, 0.8);
        /* Ubah warna header card sesuai kebutuhan */
        color: black;
        /* Ubah warna teks header card sesuai kebutuhan */
        border-radius: 10px 10px 0 0;
        /* Terapkan border-radius hanya pada sudut atas card header */
    }

    .card-body {
        padding: 20px;
        /* Tambahkan padding pada card body */
    }
</style>

    <!-- Section-->
    <section class="py-5" style="background-color: white">
        <div class="container px-4 px-lg-5 mt-5">
            <h3 class="text-center mb-5" style="color: black">Daftar Driver</h3>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($drivers as $driver)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge badge-custom {{ $driver->status == 'tersedia' ? 'bg-success' : 'bg-warning' }} text-white position-absolute" style="top: 0; right: 0">
                            {{ $driver->status }}
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ Storage::url($driver->gambar_driver) }}" alt="{{ $driver->nama_driver }}" width="200" height="200" />
                        <!-- Product details-->
                        <div class="card-body card-body-custom pt-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $driver->nama_driver }}</h5>
                                <!-- Product price-->
                                <ul class="list-unstyled list-style-group">
                                    <li class="border-bottom p-2 d-flex justify-content-between">
                                        <span>Gender</span>
                                        <span style="font-weight: 600">{{ $driver->gender }}</span>
                                    </li>
                                    <li class="border-bottom p-2 d-flex justify-content-between">
                                        <span>Usia</span>
                                        <span style="font-weight: 600">{{ $driver->usia }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
