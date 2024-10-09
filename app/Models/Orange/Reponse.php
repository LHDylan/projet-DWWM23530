<?php

namespace App\Models\Orange;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reponse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'question_id',
        'reponse',
        'vrai_faux'
    ];

    public function question():BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
