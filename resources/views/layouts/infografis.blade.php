@extends('layouts.app')

@section('title', 'Infografis Desa')

@section('content')

{{-- Style khusus untuk halaman infografis --}}
<style>
    /* Menggunakan nama kelas yang unik untuk menghindari konflik dengan Bootstrap di layout utama */
    .infografis-container { max-width: 1140px; margin: auto; padding: 2rem; }
    .infografis-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #dee2e6; padding-bottom: 1.5rem; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;}
    .header-title a { text-decoration: none; }
    .header-title h1 { margin: 0; color: #008000; font-size: 2rem; line-height: 1.2; }
    .nav-menu { display: flex; gap: 1rem; flex-wrap: wrap; }
    .nav-button { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; text-decoration: none; padding: 0.5rem; border-bottom: 3px solid transparent; color: #6c757d; font-weight: 600; transition: all 0.2s ease-in-out; }
    .nav-button svg { width: 28px; height: 28px; }
    .nav-button:hover { color: #212529; }
    .nav-button.active { color: #008000; border-bottom-color: #008000; }
    .content-section { background-color: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .section-title { font-size: 1.75rem; color: #2c3e50; margin-bottom: 1.5rem; }
    @media (max-width: 575.98px) {
        .infografis-container { padding: 1rem; }
        .content-section { padding: 1rem; }
        .header-title h1 { font-size: 1.65rem; }
        .nav-menu { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); width: 100%; gap: 0.5rem; }
        .nav-button { font-size: 0.75rem; }
    }
</style>

<div class="infografis-container">
    <div class="infografis-header">
        <div class="header-title">
            <!-- Menambahkan link untuk kembali ke halaman utama -->
            <a href="{{ url('/') }}">
                <h1>INFOGRAFIS<br>DESA SUKAMAJU</h1>
            </a>
        </div>
        <div class="nav-menu">
            <a href="{{ route('infografis.penduduk') }}" class="nav-button {{ request()->is('infografis/penduduk') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-2.438c.155-.155.293-.31.426-.469a2.126 2.126 0 0 1 2.924 0 2.126 2.126 0 0 1 0 2.924c-.155.155-.31.293-.469.426-1.996 1.996-4.582 3.102-7.344 3.102a9.337 9.337 0 0 1-4.121-2.438c-.155-.155-.293-.31-.426-.469a2.126 2.126 0 0 0-2.924 0 2.126 2.126 0 0 0 0 2.924c.155.155.31.293.469.426 1.996 1.996 4.582 3.102 7.344 3.102Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.375 21a9.337 9.337 0 0 1-4.121-2.438c-.155-.155-.293-.31-.426-.469a2.126 2.126 0 0 0-2.924 0 2.126 2.126 0 0 0 0 2.924c.155.155.31.293.469.426 1.996 1.996 4.582 3.102 7.344 3.102a9.375 9.375 0 0 0 5.105-1.72c-.174-.174-.34-.352-.5-.534a2.126 2.126 0 0 1-.34-2.812c.118-.162.247-.315.385-.458a9.337 9.337 0 0 0-4.121-2.438Z" /></svg>
                <span>Penduduk</span>
            </a>
            <a href="{{ route('infografis.apbdes') }}" class="nav-button {{ request()->is('infografis/apbdes') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>
                <span>APBDes</span>
            </a>
            <a href="{{ route('infografis.stunting') }}" class="nav-button {{ request()->is('infografis/stunting') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                <span>Stunting</span>
            </a>
            <a href="{{ route('infografis.bansos') }}" class="nav-button {{ request()->is('infografis/bansos') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A3.375 3.375 0 0 0 8.625 1.5H7.5c-1.72 0-3.223 1.17-3.687 2.859a2.25 2.25 0 0 0 .337 2.191l.54 1.08a2.25 2.25 0 0 0 2.006 1.41h4.692a2.25 2.25 0 0 0 2.006-1.41l.54-1.08a2.25 2.25 0 0 0 .337-2.191A3.375 3.375 0 0 0 12 4.875Z" /></svg>
                <span>Bansos</span>
            </a>
            <a href="{{ route('infografis.idm') }}" class="nav-button {{ request()->is('infografis/idm') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9a9.75 9.75 0 1 1 9 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" /></svg>
                <span>IDM</span>
            </a>
            <a href="{{ route('infografis.sdgs') }}" class="nav-button {{ request()->is('infografis/sdgs') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A11.953 11.953 0 0 1 12 13.5c-2.998 0-5.74-1.1-7.843-2.918m0 0A8.959 8.959 0 0 1 3 12c0-.778.099-1.533.284-2.253" /></svg>
                <span>SDGs</span>
            </a>
        </div>
    </div>

    <div class="content-section">
        @yield('infografis_content')
    </div>
</div>
@endsection
