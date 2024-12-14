<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Http;

class PengaduanController extends Controller
{
    public function create()
    {
        // Ambil data provinsi dari API
        $provinces = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json();
        return view('pengaduan.create', compact('provinces'));
    }

    public function getProvinces()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        return response()->json($response->json());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'province' => 'required|string', // Wajib diisi
            'regency' => 'required|string',
            'subdistrict' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
        

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $pengaduan = Pengaduan::create([
            'provinsi' => $request->province,
            'regency' => $request->regency,
            'subdistrict' => $request->subdistrict,
            'description' => $request->description,
            'type' => $request->type, // Simpan tipe dari request
            'image' => $imagePath,
        ]);
        
        

        if ($pengaduan) {
            return redirect()->route('guest.dashboard')->with('success', 'Pengaduan berhasil dibuat.');
        } else {
            return redirect()->back()->with('error', 'Gagal membuat pengaduan.')->withErrors(['description' => 'The description field is required.']);
        }
    }

    public function index()
    {
        $pengaduans = Pengaduan::all();
    
        // Ambil data lokasi dari API
        $provinces = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json();
        $regencies = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json')->json();
        $districts = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts.json')->json();
    
        // Map lokasi berdasarkan ID ke nama
        foreach ($pengaduans as $pengaduan) {
            // Map each ID to its name
            $pengaduan->province_name = collect($provinces)->firstWhere('id', $pengaduan->provinsi)['name'] ?? '-';
            $pengaduan->regency_name = collect($regencies)->firstWhere('id', $pengaduan->regency)['name'] ?? '-';
            $pengaduan->subdistrict_name = collect($districts)->firstWhere('id', $pengaduan->subdistrict)['name'] ?? '-';
        }
    
        return view('pengaduan.dashboard', compact('pengaduans'));
    }
    

    public function show($id)
    {
        $pengaduan = Pengaduan::with('comments')->findOrFail($id);
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function vote($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->increment('likes');
        return back()->with('success', 'Voting berhasil.');
    }

    public function comment(Request $request, $id)
    {
        $request->validate(['comment' => 'required']);
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->comments()->create(['comment' => $request->comment]);
        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function getCities($provinceId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinceId}.json");
        return response()->json($response->json());
    }

    public function getDistricts($cityId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$cityId}.json");
        return response()->json($response->json());
    }

    public function getVillages($districtId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$districtId}.json");
        return response()->json($response->json());
    }
}

