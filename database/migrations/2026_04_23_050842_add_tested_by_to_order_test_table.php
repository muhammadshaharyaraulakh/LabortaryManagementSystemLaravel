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
        Schema::table('order_test', function (Blueprint $table) {
            $table->foreignId('testedBy')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('collectedBy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_test', function (Blueprint $table) {
            $table->dropForeign(['testedBy']);
            $table->dropColumn('testedBy');
        });
    }
};