<?php

namespace App\Filament\Resources\Tims\Pages;

use App\Filament\Resources\Tims\TimResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions; // Import Actions namespace
use App\Filament\Exports\UserExporter;

class ListTims extends ListRecords
{
    protected static string $resource = TimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            // 🎯 TAMBAHKAN EXPORT ACTION DI HEADER
            Actions\ExportAction::make()
                ->label('Export Data Tim')
                // Pastikan ini merujuk ke class Exporter yang telah Anda buat
                ->exporter(UserExporter::class)
                ->color('success'),
        ];
    }
}
