<?php

namespace App\Filament\Resources\Tims\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput; // Import untuk input teks
use Filament\Forms\Components\Select; // Import untuk input select
use Filament\Forms\Components\Hidden; // Import untuk input tersembunyi
use Illuminate\Support\Facades\Hash; // Import untuk hashing

class TimForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // Atur layout 2 kolom
            ->components([
                // 1. Name
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // 2. Email
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true), // Pastikan email unik

                // 3. Password
                TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->required(fn(string $operation): bool => $operation === 'create') // Wajib saat Create
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state)) // HASHING
                    // Hanya tampilkan jika sedang Create. Jika Edit, kosongkan field password.
                    ->dehydrated(fn(string $operation): bool => $operation === 'create')
                    ->columnSpan(1),

                // 4. Regional (Relasi)
                Select::make('regional_id')
                    ->relationship('regional', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                // 5. Branch (Relasi)
                Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                // 🎯 FIELD TERSEMBUNYI UNTUK is_admin = false
                Hidden::make('is_admin')
                    ->default(false) // Nilai default false
                    ->dehydrated(true), // Pastikan field ini disimpan ke database
            ]);
    }
}
