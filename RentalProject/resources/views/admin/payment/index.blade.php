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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Daftar Pembayaran</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Tanggal Pesan</th>
                            <th>Foto Pembayaran</th>
                            <th>Foto KTP</th>
                            <th>Mobil Dipesan</th>
                            <th>Nama Driver</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $payment->nama }}</td>
                                <td class="align-middle">{{ $payment->nik }}</td>
                                <td class="align-middle">{{ $payment->tanggal }}</td>
                                <td class="align-middle"><img src="{{ Storage::url($payment->gambar_payment) }}" alt="" width="200"></td>
                                <td class="align-middle"><img src="{{ Storage::url($payment->foto_ktp) }}" alt="" width="200"></td>
                                <td class="align-middle">{{ $payment->car->nama_mobil ?? '-' }}</td>
                                <td class="align-middle">{{ $payment->driver->nama_driver ?? '-' }}</td>
                                <td class="align-middle">
                                    @if ($payment->status !== 'disetujui' && $payment->status !== 'ditolak')
                                        <form action="{{ route('admin.payment.approve', $payment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Setujui
                                            </button>
                                        </form>
                                    
                                        <form action="{{ route('admin.payment.reject', $payment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-success" disabled>
                                            Setujui
                                        </button>
                                        <button class="btn btn-sm btn-danger" disabled>
                                            Tolak
                                        </button>
                                    @endif
                                    
                                    <form onclick="return confirm('Apakah anda yakin ingin menghapus payment ini?');" class="d-inline" action="{{ route('payments.destroy', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
