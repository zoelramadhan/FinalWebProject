@extends('user.main')
@section('content')
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($cars as $car)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge badge-custom {{ $car->status == 'tersedia' ? 'bg-success' : 'bg-warning' }} text-white position-absolute" style="top: 0; right: 0">
                            {{ $car->status }}
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ Storage::url($car->gambar) }}" alt="{{ $car->nama_mobil }}" width="200" height="200" />
                        <!-- Product details-->
                        <div class="card-body card-body-custom pt-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $car->nama_mobil }}</h5>
                                <!-- Product price-->
                                <div class="rent-price mb-3">
                                    <span class="text-primary">Rp {{ number_format($car->harga_sewa, 0, ',', '.') }}/</span>day
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
