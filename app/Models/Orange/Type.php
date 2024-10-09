<?php

namespace App\Models\Orange;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['libelle'];

    public function question():HasMany
    {
        return $this->hasMany(Question::class, 'type_id');
    }
}
