<?php

namespace App\Filament\Resources\Regionals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
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

                Action::make('view_users')
                    ->label('Tim')
                    ->icon('heroicon-o-users')
                    // 🎯 Tampilkan Jumlah Users sebagai Badge
                    ->badge(fn($record): int => $record->users()->count())
                    // Opsional: Atur warna badge (misalnya hijau jika ada user, abu-abu jika nol)
                    ->badgeColor(fn($record): string => $record->users()->count() > 0 ? 'success' : 'gray')
                    ->url(
                        fn($record)
                        => UserResource::getUrl('index', [
                            'filters' => ['regional_id' => ['value' => $record->id] ],
                        ])
                    )
                    ->openUrlInNewTab(),
                DeleteAction::make(),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
