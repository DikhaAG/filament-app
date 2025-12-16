<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regional extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relasi ke User (Satu Regional memiliki banyak User)
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'regional_id');
    }
}
