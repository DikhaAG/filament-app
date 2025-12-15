<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name"),
                TextColumn::make("email")->icon(Heroicon::Envelope),
                TextColumn::make("email_verified_at")
                    ->label("Terverifikasi")
                    ->badge(function ($value) {
                        if (is_null($value)) {
                            return true;
                        } else {
                            return false;
                        }
                    })
                    ->state(fn($value) => is_null($value) ? "Belum Terverifikasi" : $value)
                    ->color(function ($value) {
                        if (is_null($value)) {
                            return "danger";
                        }
                        return "primary";
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
