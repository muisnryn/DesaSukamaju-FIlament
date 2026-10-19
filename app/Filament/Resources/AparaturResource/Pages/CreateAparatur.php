<?php

namespace App\Filament\Resources\AparaturResource\Pages;

use App\Filament\Resources\AparaturResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAparatur extends CreateRecord
{
    protected static string $resource = AparaturResource::class;

    // TAMBAHKAN KODE INI:
    protected function getRedirectUrl(): string
    {
        // Mengarahkan kembali ke halaman 'create' (form kosong)
        return $this->getResource()::getUrl('create');
    }
}
