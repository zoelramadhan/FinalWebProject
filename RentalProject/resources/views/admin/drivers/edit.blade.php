@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Form Edit Data Driver
                </div>
                <div class="card-body">
                    <form action="{{ route('drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_driver">Nama Driver</label>
                            <input type="text" name="nama_driver" class="form-control"
                                value="{{ old('nama_driver', $driver->nama_driver) }}">
                        </div>
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option {{ $driver->gender == 'pria' ? 'selected' : null }} value="pria">Pria
                            </option>
                            <option {{ $driver->gender == 'wanita' ? 'selected' : null }} value="wanita">
                                Wanita</option>
                        </select>
                        <div class="form-group">
                            <label for="usia">Usia</label>
                            <input type="text" name="usia" class="form-control"
                                value="{{ old('usia', $driver->usia) }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option {{ $driver->status == 'tersedia' ? 'selected' : null }} value="tersedia">Tersedia
                                </option>
                                <option {{ $driver->status == 'tidak tersedia' ? 'selected' : null }} value="tidak tersedia">
                                    Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5">{{ old('deskripsi', $driver->deskripsi) }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-header">
                Form Edit Gambar SIM
            </div>
            <div class="card-body">
                <form action="{{ route('drivers.updateImage', $driver->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img src="{{ Storage::url($driver->gambar_driver) }}" class="img-fluid" alt="">
                    </div>
                    <div class="form-group">
                        <label for="gambar_driver">Gambar</label>
                        <input type="file" class="form-control" name="gambar_driver">
                    </div>
                    <div class="form-group">
                        <img src="{{ Storage::url($driver->gambar_sim) }}" class="img-fluid" alt="">
                    </div>
                    <div class="form-group">
                        <label for="gambar_sim">Gambar SIM</label>
                        <input type="file" class="form-control" name="gambar_sim">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
