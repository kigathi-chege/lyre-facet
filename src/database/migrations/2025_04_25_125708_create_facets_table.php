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
        if (!Schema::hasTable('facets')) {
            Schema::create('facets', function (Blueprint $table) {
                basic_fields($table, 'facets');
                $table->string('name');
            });
        }

        if (!Schema::hasColumn('facets', 'access')) {
            Schema::table('facets', function (Blueprint $table) {
                $table->enum('access', ['public', 'private'])->default('public');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facets');
    }
};
