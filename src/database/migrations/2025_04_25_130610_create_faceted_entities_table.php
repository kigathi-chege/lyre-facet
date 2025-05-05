<?php

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
        if (!Schema::hasTable('faceted_entities')) {
            Schema::create('faceted_entities', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->morphs('entity');
                $table->foreignId('facet_value_id')->constrained('facet_values')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faceted_entities');
    }
};
