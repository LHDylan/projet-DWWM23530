<?php

namespace App\Models\Orange;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Joueur extends Model
{
    
        protected $fillable = [
            'pseudo'
        ];

        public function quizzes():BelongsToMany
    {
        return $this->belongsToMany(Quiz::class)->withPivot('score');
    }

    
    
}
