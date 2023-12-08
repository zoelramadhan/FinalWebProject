<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentStoreRequest;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('car')->get();
        return view('admin.payment.index', compact('payments'));
    }

    public function approvePayment(Payment $payment)
    {
        // Validasi apakah pembayaran sudah disetujui sebelumnya
        if ($payment->status === 'disetujui') {
            return redirect()->back()->with([
                'message' => 'Pembayaran sudah disetujui sebelumnya.',
                'alert-type' => 'warning',
            ]);
        }

        // Mengubah status pembayaran menjadi disetujui
        $payment->update(['status' => 'disetujui']);

        // Mengubah status mobil menjadi tidak tersedia
        $car = $payment->car;
        $car->update(['status' => 'tidak tersedia']);

        // Jika driver dipilih, ubah status driver menjadi tidak tersedia
        if ($payment->sewa_driver) {
            $driver = $payment->driver;
            $driver->update(['status' => 'tidak tersedia']);
        }

        return redirect()->back()->with([
            'message' => 'Pembayaran berhasil disetujui.',
            'alert-type' => 'success',
        ]);
    }

    public function rejectPayment(Payment $payment)
    {
        // Validasi apakah pembayaran sudah ditolak sebelumnya
        if ($payment->status === 'ditolak') {
            return redirect()->back()->with([
                'message' => 'Pembayaran sudah ditolak sebelumnya.',
                'alert-type' => 'warning',
            ]);
        }

        // Mengubah status pembayaran menjadi ditolak
        $payment->update(['status' => 'ditolak']);

        // Mengubah status mobil menjadi tersedia
        $car = $payment->car;
        $car->update(['status' => 'tersedia']);

        // Jika driver dipilih, ubah status driver menjadi tersedia
        if ($payment->sewa_driver) {
            $driver = $payment->driver;
            $driver->update(['status' => 'tersedia']);
        }

        return redirect()->back()->with([
            'message' => 'Pembayaran berhasil ditolak.',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(Payment $payment)
    {
        // Simpan informasi mobil dan driver sebelum menghapus pembayaran
        $car = $payment->car;
        $driver = $payment->driver;
    
        // Hapus pembayaran
        $payment->delete();
    
        // Ubah status mobil menjadi tersedia
        if ($car) {
            $car->update(['status' => 'tersedia']);
        }
    
        // Ubah status driver menjadi tersedia
        if ($driver) {
            $driver->update(['status' => 'tersedia']);
        }
    
        return redirect()->route('payments.index')->with([
            'message' => 'Pembayaran berhasil dihapus.',
            'alert-type' => 'success',
        ]);
    }

    public function store(PaymentStoreRequest $request)
    {
        // Validasi request
        $validatedData = $request->validated();

        // Simpan gambar_payment ke storage
        $gambarPaymentPath = $request->file('gambar_payment')->store('assets/payment', 'public');

        // Buat slug dari NIK
        $slug = Str::slug($validatedData['nik'], '-');

        // Buat entitas Payment dengan data yang diberikan
        $payment = Payment::create([
            'nama' => $validatedData['nama'],
            'nik' => $validatedData['nik'],
            'tanggal' => $validatedData['tanggal'],
            'gambar_payment' => $gambarPaymentPath,
            'slug' => $slug,
        ]);

        // Temukan mobil berdasarkan slug yang diberikan
        $carSlug = $request->input('car_slug');
        $car = Car::where('slug', $carSlug)->first();

        // Hubungkan entitas Payment dengan mobil yang sesuai
        $payment->car()->associate($car);
        $payment->save();

        // Redirect ke halaman pembayaran dengan pesan sukses
        return redirect()->route('payment.index')->with([
            'message' => 'Pembayaran berhasil',
            'alert-type' => 'success'
        ]);
    }



}
