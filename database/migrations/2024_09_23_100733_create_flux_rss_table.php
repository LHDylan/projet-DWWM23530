<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flux_rss', function (Blueprint $table) {
            $table->id();
            $table->string('nom_flux');
            $table->string('url_flux');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('flux_rss')->insert([
            ['nom_flux' => 'FranceTV - Info', 'url_flux' => 'https://www.francetvinfo.fr/titres.rss']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flux_rss');
    }
};
