<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("name")->required(),
                TextInput::make("email")->email()->required(),
                TextInput::make("password")
                    ->password()
                    // Hanya wajib saat membuat user baru
                    ->required(fn(string $operation): bool => $operation === 'create')
                    // Mengubah state menjadi hash sebelum disimpan
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    // Pastikan password tidak di-hash saat edit jika tidak diubah
                    ->dehydrated(fn(string $operation): bool => $operation === 'create')
                    // Sembunyikan field saat mengedit user
                    ->hiddenOn('edit'),
                // 1. Checkbox is_admin
                Checkbox::make('is_admin')
                    ->label('Administrator'), // Label di Form

                // 2. Dropdown Regional (Relasi: regional_id)
                Select::make('regional_id')
                    ->relationship('regional', 'name') // Mengambil nama dari Model Regional
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->label('Regional'),

                // 3. Dropdown Branch (Relasi: branch_id)
                Select::make('branch_id')
                    ->relationship('branch', 'name') // Mengambil nama dari Model Branch
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->label('Branch'),
            ]);
    }
}
