<?php

namespace App\Models\Vert;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Un rôle peut être assigné à plusieurs utilisateurs
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}