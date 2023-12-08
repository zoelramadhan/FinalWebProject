@extends('user.main')
@section('content')
<style>
    .card {
        background-color: rgba(255, 255, 255, 1);
        /* RGBA dengan tingkat transparansi 0.8 */
        border-radius: 10px;
        /* Tambahkan border-radius untuk memberikan sudut yang sedikit melengkung */
        box-shadow: 0 0 10px rgba(0, 0, 0, 1);
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

    /* Tambahkan gaya untuk header transparan */
    header {
        background-color: rgba(255, 255, 255, 2);
        /* Atur nilai transparansi sesuai kebutuhan */
        padding: 20px;
        /* Sesuaikan padding sesuai kebutuhan */
    }
</style>
    <header class="">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text">
                    <h1 style="text-shadow: 1px 1px 1px rgb(255, 255, 255)" class="display-4 fw-bolder" style="color: black" >Sistem Pemesanan Mobil</h1>
                    <p class="lead fw-normal text-gray mb-0">
                        Ngerental lebih mudah dengan kami
                    </p>
                <form class="d-flex align-items-center mt-3" role="search" action="{{ route('user.search') }}" method="GET">
                    <input class="form-control me-3" type="search" name="jenis" placeholder="Search Product"
                        aria-label="Search">
                    <button class="btn me-5" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                            height="30" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="color: black">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></button>
                </form>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3 class="text-center mb-5" style="color: white">Daftar Mobil</h3>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($cars as $car)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge badge-custom {{ $car->status == 'tersedia' ? 'bg-success' : 'bg-warning' }} text-white position-absolute"
                                style="top: 0; right: 0">
                                {{ $car->status }}
                            </div>
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ Storage::url($car->gambar) }}" alt="{{ $car->nama_mobil }}"
                                width="200" height="200" />
                            <!-- Product details-->
                            <div class="card-body card-body-custom pt-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $car->nama_mobil }}</h5>
                                    <!-- Product price-->
                                    <div class="rent-price mb-3">
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
                            <div class="card-footer border-top-0 bg-transparent">
                                <div class="text-center">
                                    @if ($car->status == 'tersedia')
                                        <a class="btn btn-primary mt-auto" href="{{ route('payment', ['car_slug' => $car->slug]) }}">Sewa</a>
                                    @else
                                        <button class="btn btn-secondary mt-auto" disabled>Sewa</button>
                                    @endif
                                    <a class="btn btn-info mt-auto text-white" href="{{ route('user.detail', $car->slug) }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
