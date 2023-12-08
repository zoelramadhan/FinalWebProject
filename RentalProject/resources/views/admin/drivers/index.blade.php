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
            <h3>Daftar Driver</h3>
            <a href="{{ route('drivers.create') }}" class="btn btn-primary">Tambah Driver</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th>No</th>
                            <th>Nama Driver</th>
                            <th>Gambar Driver</th>
                            <th>Gambar SIM</th>
                            <th>Gender</th>
                            <th>Usia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($drivers as $driver)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $driver->nama_driver }}</td>
                                <td class="align-middle">
                                    <img src="{{ Storage::url($driver->gambar_driver) }}" alt="" width="200">
                                </td>
                                <td class="align-middle">
                                    <img src="{{ Storage::url($driver->gambar_sim) }}" alt="" width="200">
                                </td>
                                <td class="align-middle">{{ $driver->gender }}</td>
                                <td class="align-middle">{{ $driver->usia }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('drivers.edit', $driver->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form onclick="return confirm('Apakah anda yakin ingin menghapus data?');"
                                        class="d-inline" action="{{ route('drivers.destroy', $driver->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
