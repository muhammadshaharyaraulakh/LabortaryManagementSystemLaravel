<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('test_parameters', function (Blueprint $table) {
            $table->string('unit')->nullable()->change();
            $table->string('normalRange')->nullable()->change();
            $table->json('options')->nullable()->after('inputType');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_parameters', function (Blueprint $table) {
            $table->string('unit')->nullable(false)->change();
            $table->string('normalRange')->nullable(false)->change();
            $table->dropColumn('options');
        });
    }
};
