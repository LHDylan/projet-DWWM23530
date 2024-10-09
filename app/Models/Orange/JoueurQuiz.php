<?php

namespace App\Models\Orange;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JoueurQuiz extends Pivot
{
    protected $fillable = [
        'score',
        'joueur_id',
        'quiz_id'
    ];

    protected function casts(): array
    {
        return ['score' => 'integer'];
    }
}
