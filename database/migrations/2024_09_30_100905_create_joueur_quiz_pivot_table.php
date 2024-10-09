<?php

use App\Models\Orange\Joueur;
use App\Models\Orange\Quiz;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('joueur_quiz', static function (Blueprint $table): void {
            $table->integer('score');
            $table->foreignIdFor(Joueur::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Quiz::class)->constrained()->cascadeOnDelete();
            $table->primary(['joueur_id', 'quiz_id']);
            $table->index('joueur_id');
            $table->index('quiz_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueur_quiz');
    }
};
