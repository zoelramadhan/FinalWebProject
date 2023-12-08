<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverStoreRequest;
use App\Http\Requests\Admin\DriverUpdateRequest;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::latest()->get();

        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverStoreRequest $request)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->nama_driver, '-');

            $gambar_sim = $request->file('gambar_sim')->store('assets/driver', 'public');
            $gambar_driver = $request->file('gambar_driver')->store('assets/driver1', 'public');

            Driver::create([
                'nama_driver' => $request->nama_driver,
                'gambar_sim' => $gambar_sim,
                'gambar_driver' => $gambar_driver,
                'slug' => $slug,
                'gender' => $request->gender,
                'usia' => $request->usia,
                'status' => $request->status,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        return redirect()->route('drivers.index')->with([
            'message' => 'Data Berhasil Dibuat',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverUpdateRequest $request, Driver $driver)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->nama_driver, '-');
            $driver->update($request->validated() + ['slug' => $slug]);
        }

        return redirect()->route('drivers.index')->with([
            'message' => 'Data Berhasil Diedit',
            'alert-type' => 'info'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        if ($driver->gambar_sim) {
            unlink('storage/' . $driver->gambar_sim);
        }
        if ($driver->gambar_driver) {
            unlink('storage/' . $driver->gambar_driver);
        }        
        $driver->delete();

        return redirect()->back()->with([
            'message' => 'Data Berhasil DiHapus',
            'alert-type' => 'danger'
        ]);
    }

    public function updateImage(Request $request, $driverId)
    {
        $request->validate([
            'gambar_sim' => 'required|image'
        ]);
        $driver = Driver::findOrFail($driverId);
        if ($request->gambar_sim) {
            unlink('storage/' . $driver->gambar_sim);
            $gambar_sim = $request->file('gambar_sim')->store('assets/driver', 'public');

            $driver->update(['gambar_sim' => $gambar_sim]);
        }

        return redirect()->back()->with([
            'message' => 'Gambar Berhasil Diedit',
            'alert-type' => 'info'
        ]);
    }
}
