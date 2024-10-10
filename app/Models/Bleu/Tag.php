<?php

namespace App\Models\Bleu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['name'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
