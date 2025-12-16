<?php

namespace App\Filament\Resources\Regionals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;

class RegionalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                // --- Aksi Baru: Lihat Users (Filter Regional) ---
                Action::make('view_users')
                    ->label('Lihat Users')
                    ->icon('heroicon-o-users')
                    ->url(
                        fn($record)
                        // Menggunakan UserResource::getUrl untuk membuat URL ke halaman index Users
                        => UserResource::getUrl('index', [
                            // Menambahkan parameter filter untuk Regional ID
                            'tableFilters' => ['regional_id' => $record->id],
                        ])
                    )
                    ->openUrlInNewTab(), // Opsional: Buka di tab baru
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
