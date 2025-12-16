<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("email")
                    ->icon(Heroicon::Envelope)
                    ->searchable()
                    ->sortable(),
                // Kolom is_admin (1. Menambahkan kolom is_admin)
                IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean()
                    ->sortable(), // Ikon centang/silang

                // Kolom Relasi Regional (2. Menambahkan kolom regional.name)
                TextColumn::make('regional.name')
                    ->label('Regional')
                    ->searchable()
                    ->sortable(),

                // Kolom Relasi Branch (3. Menambahkan kolom branch.name)
                TextColumn::make('branch.name')
                    ->label('Branch')
                    ->searchable()
                    ->sortable(),
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
                SelectFilter::make('regional_id')
                    ->relationship('regional', 'name')
                    ->label('Filter Regional'),

                SelectFilter::make('branch_id')
                    ->relationship('branch', 'name')
                    ->label('Filter Branch'),
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
