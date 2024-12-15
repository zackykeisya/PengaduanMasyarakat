@extends('templates.app')

@section('content')
<main class="flex-1 p-10 bg-gray-100 bg-cover bg-center" style="background-image: url('https://i.pinimg.com/736x/75/c3/8b/75c38b45a23ce87850d791ca30a9f4b1.jpg');">
    <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-indigo-700 mb-4">Welcome to the Dashboard</h1>
        <p class="text-gray-700 leading-relaxed">Manage your data and access important features with ease.</p>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Auth Check -->
        @if (Auth::check())
            <p class="text-gray-800 mt-4 font-medium">Welcome, <strong>{{ Auth::user()->email }}</strong></p>
        @else
            <p class="text-red-500 mt-4 font-medium">Anda belum login!</p>
        @endif

        <!-- Dropdown Menu for Filtering -->
        <div class="mt-8">
            <label for="provinsiFilter" class="block text-sm text-gray-600 font-semibold">Filter Berdasarkan Provinsi</label>
            <select id="provinsiFilter" class="w-full border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="" selected>Semua Provinsi</option>
                <!-- Data provinsi akan di-load melalui JavaScript -->
            </select>
        </div>

        <!-- Pengaduan List -->
    </div>
</main>

<div id="pengaduanList" class="mt-6">
    @if($pengaduans && $pengaduans->isNotEmpty())
        @foreach ($pengaduans as $pengaduan)
            <article class="bg-white shadow-lg rounded-lg p-6 mb-6 border border-gray-300 hover:shadow-2xl transition-shadow duration-300" data-provinsi="{{ $pengaduan->provinsi }}">
                <h2 class="text-xl font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-exclamation-circle mr-2 text-blue-500"></i>
                    Tipe Keluhan: {{ ucfirst(strtolower($pengaduan->type)) }}
                </h2>
                <p class="text-gray-600 text-sm mb-3">
                    <strong class="font-medium">Lokasi:</strong> {{ $pengaduan->subdistrict }}, {{ $pengaduan->regency }}, {{ $pengaduan->provinsi }}
                </p>
                <p class="text-gray-700 mb-5 text-sm">
                    {{ $pengaduan->description }}
                </p>

                @if ($pengaduan->image)
                    <img src="{{ asset('storage/' . $pengaduan->image) }}" 
                         alt="Gambar Pengaduan" 
                         class="w-full max-h-60 object-cover rounded-lg shadow-md mb-5 border border-gray-300 hover:opacity-80 transition-opacity duration-300">
                @endif

                <p class="text-gray-500 text-xs mb-2">Dibuat pada: {{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                <p class="text-gray-500 text-xs mb-4">Views: {{ $pengaduan->viewers }} | Likes: {{ $pengaduan->votes }}</p>

                <!-- Comments Section -->
                <div class="mt-6">
                    <h3 class="text-md font-semibold text-gray-700 mb-3">
                        <i class="fas fa-comments mr-2 text-gray-500"></i> Komentar:
                    </h3>
                    @foreach ($pengaduan->komentar ?? [] as $komentar)
                        <div class="bg-gray-100 p-4 rounded-lg mb-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <p class="text-gray-700 text-sm">{{ $komentar->comment }}</p>
                        </div>
                    @endforeach

                    <!-- Add Comment Form -->
                    <form action="{{ route('pengaduan.comment', $pengaduan->id) }}" method="POST" class="space-y-4 mt-6">
                        @csrf
                        <textarea name="comment" placeholder="Tulis komentar..." class="w-full p-4 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 text-sm" rows="3" required></textarea>
                        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300 text-xs focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Komentar
                        </button>
                    </form>
                </div>
            </article>
        @endforeach
    @else
        <p id="noDataMessage" class="text-gray-700 text-center text-lg">Belum ada pengaduan yang dibuat.</p>
    @endif
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil data provinsi menggunakan API
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(data => {
                const provinsiFilter = document.getElementById('provinsiFilter');
                
                // Tambahkan option ke dropdown
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.name;
                    provinsiFilter.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading provinces:', error);
            });
        
        const provinsiFilter = document.getElementById('provinsiFilter');
        const pengaduanList = document.getElementById('pengaduanList');
        const noDataMessage = document.getElementById('noDataMessage');

        provinsiFilter.addEventListener('change', function() {
            const selectedProvinsi = this.value;

            // Filter items berdasarkan provinsi yang dipilih
            const articles = pengaduanList.querySelectorAll('article');
            let visibleCount = 0;

            articles.forEach(article => {
                // Gunakan dataset untuk memeriksa apakah provinsi cocok
                if (selectedProvinsi === '' || article.dataset.provinsi === selectedProvinsi) {
                    article.style.display = 'block';
                    visibleCount++;
                } else {
                    article.style.display = 'none';
                }
            });

            // Show/hide the no data message
            if (visibleCount === 0) {
                noDataMessage.style.display = 'block';
            } else {
                noDataMessage.style.display = 'none';
            }
        });
    });
</script>
@endsection
