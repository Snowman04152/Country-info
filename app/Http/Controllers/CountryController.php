<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CountryController extends Controller
{
    // Menampilkan daftar negara
    public function index()
    {
        // Ambil data dari REST Countries API
        $response = Http::timeout(60)->get('https://restcountries.com/v3.1/region/asia');
        $countries = $response->json();

        // Kirim data ke view
        return view('countries.index', compact('countries'));
    }

    // Menampilkan detail negara
    public function show($name)
    {
        // Ambil data negara berdasarkan nama
        $response = Http::timeout(60)->get("https://restcountries.com/v3.1/name/{$name}");
        $country = $response->json()[0]; // Ambil data pertama dari array

        // Kirim data ke view
        return view('countries.show', compact('country'));
    }

    // Handle request pencarian
    public function search(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'nullable|string',
        'code' => 'nullable|string|max:3',
    ]);

    // Ambil parameter dari form
    $name = $request->input('name');
    $code = $request->input('code');

    // Buat URL berdasarkan parameter yang diberikan
    if ($name) {
        $url = "https://restcountries.com/v3.1/name/{$name}";
    } elseif ($code) {
        $url = "https://restcountries.com/v3.1/alpha/{$code}";
    } else {
        // Jika tidak ada parameter, kembalikan ke halaman utama
        return redirect('/');
    }

    // Ambil data dari API
    $response = Http::timeout(60)->get($url);

    // Jika data tidak ditemukan, tampilkan pesan error
    if ($response->status() === 404) {
        return redirect('/')->with('error', 'Data tidak ditemukan.');
    }

    $countries = $response->json();

    // Kirim data ke view
    return view('countries.index', compact('countries'));
}
}