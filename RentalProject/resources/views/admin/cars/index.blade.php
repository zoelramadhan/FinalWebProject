@extends('layouts.admin')

<style>
    thead tr th {
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    tbody tr td {
        justify-content: center;
        align-items: center;
        text-align: center;
    }
</style>

@section('content')

    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Daftar Mobil</h3>
            <a href="{{ route('cars.create') }}" class="btn btn-primary">Tambah Mobil</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th>No</th>
                            <th>Nama Mobil</th>
                            <th>Gambar Mobil</th>
                            <th>Harga Sewa</th>
                            <th>Status Mobil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cars as $car)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $car->nama_mobil }}</td>
                                <td class="align-middle">
                                    <img src="{{ Storage::url($car->gambar) }}" alt="" width="200">
                                </td>
                                <td class="align-middle">Rp {{ number_format($car->harga_sewa, 0, ',', '.') }}</td>
                                <td class="align-middle">{{ $car->status }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('cars.edit', $car->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form onclick="return confirm('Apakah anda yakin ingin menghapus data?');"
                                        class="d-inline" action="{{ route('cars.destroy', $car->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
