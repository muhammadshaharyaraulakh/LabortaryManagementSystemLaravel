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
            DB::statement("ALTER TABLE order_test MODIFY COLUMN status ENUM('Created', 'Collected', 'InProgress','Unverified', 'Completed') DEFAULT 'Created'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_test', function (Blueprint $table) {
            //
        });
    }
};
