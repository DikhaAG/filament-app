<?php

namespace App\Filament\Resources\Admins\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Hash;

class AdminForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make("name")
                    ->required()
                    ->maxLength(255),

                TextInput::make("email")
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make("password")
                    ->password()
                    ->maxLength(255)
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->dehydrated(fn(string $operation): bool => $operation === 'create')
                    ->columnSpan('full'), // Password penuh 1 kolom

                // 🎯 Is Admin = TRUE secara otomatis
                Hidden::make('is_admin')
                    ->default(true)
                    ->dehydrated(true),

                // 🎯 Regional dan Branch diset NULL
                Hidden::make('regional_id')
                    ->default(null)
                    ->dehydrated(true),

                Hidden::make('branch_id')
                    ->default(null)
                    ->dehydrated(true),
            ]);
    }
}
