<?php

namespace App\Filament\Resources\Tims\Tables;

use App\Filament\Resources\Users\UserResource; // <-- Wajib: Untuk navigasi Edit
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
/* use Filament\Tables\Actions\Action; // <-- Wajib: Menggantikan EditAction bawaan */
use Filament\Actions\Action; // <-- Wajib: Menggantikan EditAction bawaan
use Filament\Tables\Columns\TextColumn; // <-- Wajib: Untuk menampilkan data
use Filament\Tables\Table;

class TimsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Kolom Name
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                // 2. Kolom Email
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                // 3. Kolom Regional (Relasi)
                TextColumn::make('regional.name')
                    ->label('Regional')
                    ->sortable(),

                // 4. Kolom Branch (Relasi)
                TextColumn::make('branch.name')
                    ->label('Branch')
                    ->sortable(),
            ])
            ->filters([
                // Anda bisa menambahkan SelectFilter untuk Regional/Branch di sini jika diperlukan
            ])
            ->recordActions([
                // GANTI EditAction::make() dengan Aksi Kustom
                Action::make('edit_full_user')
                    ->label('Edit User Penuh')
                    ->icon('heroicon-o-pencil')
                    ->color('primary')
                    // 🎯 Logika Navigasi: Arahkan ke halaman 'edit' di UserResource
                    // $record adalah model User saat ini
                    ->url(fn($record): string => UserResource::getUrl('edit', ['record' => $record->id]))
                    ->openUrlInNewTab(),
                // ----------------------------------------------------
            ])
            ->toolbarActions([
                // Kita pertahankan BulkActionGroup, tetapi Anda mungkin ingin menghapus DeleteBulkAction
                // karena penghapusan user sebaiknya dikelola di UserResource utama.
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
