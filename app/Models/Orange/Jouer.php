<?php

namespace App\Models\Orange;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jouer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'joueur_id',
        'quiz_id',
        'score'
    ];

    public function quizzes():BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function joueurs():BelongsTo
    {
        return $this->belongsTo(Joueur::class);
    }


}
