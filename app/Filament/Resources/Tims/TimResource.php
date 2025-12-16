<?php

namespace App\Filament\Resources\Tims;

// Hapus use App\Models\Tim;
use App\Models\User; // <-- BARU: Import Model User
use App\Filament\Resources\Tims\Pages\ListTims;
use App\Filament\Resources\Tims\Schemas\TimForm;
use App\Filament\Resources\Tims\Tables\TimsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder; // <-- BARU: Import Builder

class TimResource extends Resource
{
    // UBAH MODEL: Arahkan ke Model User
    protected static ?string $model = User::class;

    // UBAH ICON & LABEL (Opsional)
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup; // Ikon Group
    protected static ?string $navigationLabel = 'Daftar Tim';
    protected static ?string $recordTitleAttribute = 'name'; // Dari prompt
    protected static ?string $pluralModelLabel = 'Daftar Anggota Tim'; // Label yang akan muncul di header

    // 🎯 TAMBAHKAN FILTER QUERY: Hanya User dengan is_admin = false
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('is_admin', false);
    }

    public static function form(Schema $schema): Schema
    {
        return TimForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TimsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Hapus halaman create dan edit lokal
    public static function getPages(): array
    {
        return [
            'index' => ListTims::route('/'),
            // 'create' => CreateTim::route('/create'), // HAPUS INI
            // 'edit' => EditTim::route('/{record}/edit'), // HAPUS INI
        ];
    }
}
