<?php

namespace App\Http\Controllers\User;

use App\Models\Car;
use App\Models\Driver;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\PaymentStoreRequest;

class UserController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->get();
        return view('user.homepage', compact('cars'));
    }

    public function car()
    {
        $cars = Car::latest()->get();
        return view('user.car', compact('cars'));
    }

    public function driver()
    {
        $drivers = Driver::latest()->get();
        return view('user.driver', compact('drivers'));
    }

    public function detail(Car $car)
    {
        return view('user.detail', compact('car'));
    }

    public function payment(Request $request)
    {
        $carSlug = $request->query('car_slug');
        $car = Car::where('slug', $carSlug)->first();

        $drivers = Driver::where('status', 'tersedia')->get();

        // Ganti 'status' dengan kolom yang sesuai pada tabel pembayaran
        $payment = Payment::where('car_id', $car->id)
            ->where('status', 'menunggu') // Ganti dengan nama kolom yang benar
            ->first();

        return view('user.payment', compact('car', 'drivers', 'payment'));
    }

    public function paymentStore(PaymentStoreRequest $request)
    {
        // Validasi request
        $validatedData = $request->validated();

        // Temukan mobil berdasarkan slug yang diberikan
        $carSlug = $request->input('car_slug');
        $car = Car::where('slug', $carSlug)->first();

        // Periksa status mobil, jika tidak tersedia, kembalikan dengan pesan error
        if ($car->status === 'tidak tersedia') {
            return redirect()->back()->with([
                'message' => 'Maaf, mobil tidak tersedia untuk disewa.',
                'alert-type' => 'error'
            ]);
        }

        // Simpan gambar_payment dan foto_ktp ke storage
        $gambarPaymentPath = $request->file('gambar_payment')->store('assets/payment', 'public');
        $fotoKtpPath = $request->file('foto_ktp')->store('assets/foto_ktp', 'public');

        // Buat slug dari NIK
        $slug = Str::slug($validatedData['nik'], '-');

        // Buat entitas Payment dengan status awal "menunggu"
        $payment = Payment::create([
            'nama' => $validatedData['nama'],
            'nik' => $validatedData['nik'],
            'tanggal' => $validatedData['tanggal'],
            'gambar_payment' => $gambarPaymentPath,
            'foto_ktp' => $fotoKtpPath,
            'slug' => $slug,
            'sewa_driver' => $request->input('driver', 0),
            'status' => 'menunggu', // Set status awal
        ]);

        // Hubungkan entitas Payment dengan mobil yang sesuai
        $payment->car()->associate($car);

        // Jika driver dipilih, hubungkan pembayaran dengan driver
        if ($request->input('driver')) {
            $driver = Driver::find($request->input('driver'));

            // Ubah status driver menjadi tidak tersedia
            $driver->update(['status' => 'tidak tersedia']);

            $payment->driver()->associate($driver);
        }

        $payment->save();

        // Redirect ke halaman pembayaran dengan pesan sukses
        return redirect()->route('user.index')->with([
            'message' => 'Payment Berhasil di kirim',
            'alert-type' => 'success'
        ]);
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes
        $user->save();

        return redirect()->route('user.index')->with([
            'message' => 'Profile successfully updated.',
            'alert-type' => 'success'
        ]);
    }

    public function search(Request $request)
    {
        $nama_mobil = $request->input('search'); // Ambil nilai yang diinputkan pengguna
        $jumlah_kursi = $request->input('search'); // Ambil nilai yang diinputkan pengguna
    
        $cars = Car::where('nama_mobil', 'like', '%' . $nama_mobil . '%')->get();
        $cars = Car::where('jumlah_kursi', 'like', '%' . $jumlah_kursi . '%')->get();
        return view('user.search', ['cars' => $cars]);
    }

}
