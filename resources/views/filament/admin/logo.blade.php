@php
    $brandLogo = asset('images/logo-desa.png');
@endphp

<div class="px-4 py-4">
    <div class="flex items-center gap-3">
        <img src="{{ $brandLogo }}" alt="Logo Desa" class="h-10 w-10">
        <span class="font-semibold text-white hidden sm:block">Desa Sukamaju</span>
    </div>
</div>
