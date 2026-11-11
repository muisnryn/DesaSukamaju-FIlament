@extends('layouts.app')

@section('title', 'Peta Desa Sukamaju | Lokasi dan Fasilitas')
@section('meta_description', 'Jelajahi peta Desa Sukamaju dan temukan lokasi serta titik penting di Kecamatan Cibeber, Kabupaten Cianjur.')

@push('styles')
{{-- Menambahkan CSS Leaflet ke dalam <head> --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    /* Gaya untuk halaman peta & listing */
    .map-listing-wrapper {
        font-family: sans-serif; 
        background-color: #f4f4f9; 
        color: #333; 
        padding: 40px 20px;
    }
    .map-listing-container {
        max-width: 1400px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
    }
    .map-column {
        flex: 3; /* Peta mengambil ruang lebih besar */
        min-width: 300px;
        min-height: 600px; /* Menambahkan tinggi minimal agar tidak kolaps */
    }
    .listing-column {
        flex: 1; /* Daftar mengambil ruang lebih kecil */
        min-width: 280px;
        max-height: 600px; /* Samakan tinggi dengan peta */
        overflow-y: auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 1px solid #ddd;
    }
    #map { 
        width: 100%;
        height: 100%; /* Ubah tinggi menjadi 100% agar mengisi kolom */
        min-height: 600px;
        border-radius: 10px;
        z-index: 0;
    }
    .listing-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        background-color: #f8f9fa;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .listing-header h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #4a4a4a;
    }
    .location-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .location-item {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .location-item:hover {
        background-color: #f1f1f1;
    }
    .location-item:last-child {
        border-bottom: none;
    }
    .location-item h4 {
        margin: 0 0 5px 0;
        font-size: 1rem;
        color: #0d6efd;
    }
    .location-item p {
        margin: 0;
        font-size: 0.85rem;
        color: #6c757d;
    }
    .location-item-empty p {
        padding: 20px;
        color: #6c757d;
    }
    @media (max-width: 575.98px) {
        .map-listing-wrapper { padding: 24px 12px; }
        .map-column, #map { min-height: 400px; }
        .listing-column { max-height: 400px; }
    }
</style>
@endpush

@section('content')
<div class="map-listing-wrapper">
    <div class="map-listing-container">
        <!-- Kolom Peta -->
        <div class="map-column">
            <div id="map"></div>
        </div>

        <!-- Kolom Daftar Lokasi (Sidebar) -->
        <div class="listing-column">
            <div class="listing-header">
                <h3>Lokasi Penting</h3>
            </div>
            <ul class="location-list">
                @forelse($locations ?? [] as $location)
                    <li class="location-item" data-lat="{{ $location->latitude }}" data-lng="{{ $location->longitude }}" data-id="{{ $location->id }}">
                        <h4>{{ $location->nama }}</h4>
                        <p>{{ $location->kategori }}</p>
                    </li>
                @empty
                    <li class="location-item-empty">
                        <p>Belum ada lokasi yang ditambahkan.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Menambahkan JS Leaflet sebelum penutup </body> --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ganti koordinat dengan titik tengah desa Anda
        var map = L.map('map').setView([-6.9839, 106.9818], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var locations = @json($locations ?? []);
        var markers = {}; // Objek untuk menyimpan semua marker

        // Buat marker dan simpan referensinya
        locations.forEach(function(location) {
            if (location.latitude && location.longitude) {
                var marker = L.marker([location.latitude, location.longitude]).addTo(map);
                var popupContent = `<b>${location.nama}</b><br><i>Kategori: ${location.kategori}</i><br>${location.deskripsi || ''}`;
                marker.bindPopup(popupContent);

                // Simpan marker menggunakan ID lokasi sebagai key
                markers[location.id] = marker;
            }
        });

        // Tambahkan event listener untuk setiap item di daftar lokasi
        document.querySelectorAll('.location-item').forEach(function(item) {
            item.addEventListener('click', function() {
                var lat = this.dataset.lat;
                var lng = this.dataset.lng;
                var id = this.dataset.id;

                if (lat && lng) {
                    map.setView([lat, lng], 17); // Zoom lebih dekat saat diklik

                    // Buka popup pada marker yang sesuai
                    if (markers[id]) {
                        markers[id].openPopup();
                    }
                }
            });
        });
    });
</script>
@endpush
