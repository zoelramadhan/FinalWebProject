@extends('layouts.frontend')
@section('content')
    <style>
        .card {
            background-color: rgba(255, 255, 255, 0);
            /* RGBA dengan tingkat transparansi 0.8 */
            border-radius: 10px;
            /* Tambahkan border-radius untuk memberikan sudut yang sedikit melengkung */
            box-shadow: 0 0 10px rgba(177, 173, 173, 0.1);
            /* Tambahkan box-shadow untuk efek bayangan */
        }  

        .card-header {
            background-color: rgba(0, 123, 255, 0.8);
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

        header {
            background-color: rgba(255, 255, 255, 0);
            /* Atur nilai transparansi sesuai kebutuhan */
            padding: 20px;
            /* Sesuaikan padding sesuai kebutuhan */
        }
    </style>
    <header class="" style="background-color: white">
        <div class="container px-4 px-lg-5 my-5"  >
            <div class="text-center text-black" >
                <h1 style="text-shadow: 1px 1px 1px white" class="display-4 fw-bolder">Sistem Pemesanan Mobil</h1>
                <p class="lead fw-normal mb-0" white style="color: #000000">
                    Ngerental lebih mudah dengan kami
                </p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            @if (count($cars) > 0)
            <h3 class="text-center mb-5" style="color: white">Daftar Mobil</h3>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($cars->take(5) as $car)
                        <div class="col mb-5" style="background-color: white">
                            <div class="card h-100" style="background-color: white">
                                <!-- Sale badge-->
                                <div class="badge badge-custom {{ $car->status == 'tersedia' ? 'bg-success' : 'bg-warning' }} text-white position-absolute"
                                    style="top: 0; right: 0">
                                    {{ $car->status }}
                                </div>
                                <!-- Product image-->
                                <img class="card-img-top" src="{{ Storage::url($car->gambar) }}"
                                    alt="{{ $car->nama_mobil }}" width="200" height="200" />
                                <!-- Product details-->
                                <div class="card-body card-body-custom pt-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $car->nama_mobil }}</h5>
                                        <!-- Product price-->
                                        <div class="rent-price mb-3" style="color: black">
                                            <span class="text-primary">Rp
                                                {{ number_format($car->harga_sewa, 0, ',', '.') }}/</span>day
                                        </div>
                                        <ul class="list-unstyled list-style-group">
                                            <li class="border-bottom p-2 d-flex justify-content-between">
                                                <span>Bahan Bakar</span>
                                                <span style="font-weight: 600">{{ $car->bahan_bakar }}</span>
                                            </li>
                                            <li class="border-bottom p-2 d-flex justify-content-between">
                                                <span>Jumlah Kursi</span>
                                                <span style="font-weight: 600">{{ $car->jumlah_kursi }}</span>
                                            </li>
                                            <li class="border-bottom p-2 d-flex justify-content-between">
                                                <span>Transmisi</span>
                                                <span style="font-weight: 600">{{ $car->transmisi }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer border-top-0 bg-white">
                                    <div class="text-center">
                                        <a class="btn btn-primary mt-auto" href="{{ route('login') }}">Sewa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <p class="lead fw-normal text-white mt-5">Maaf, saat ini tidak ada mobil yang tersedia.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
