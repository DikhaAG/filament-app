<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
use App\Filament\Exports\UserExporter;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Actions\ExportAction::make()
                ->label('Export Data Tim') // Nama tombol sesuai permintaan
                ->exporter(UserExporter::class)
                ->color('success'),
        ];
    }
}
