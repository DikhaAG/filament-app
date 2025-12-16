<?php

namespace App\Filament\Resources\Tims\Pages;

use App\Filament\Resources\Tims\TimResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTim extends CreateRecord
{
    protected static string $resource = TimResource::class;
    protected static ?string $title = 'Daftar Anggota Tim'; // Label yang akan muncul di header
    // 🎯 Arahkan ke halaman 'index' (Daftar Tim) setelah berhasil membuat
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
