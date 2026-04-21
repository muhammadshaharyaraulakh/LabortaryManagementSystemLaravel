<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_test', function (Blueprint $table) {
            DB::statement("ALTER TABLE order_test MODIFY COLUMN status ENUM('Created', 'Collected', 'InProgress', 'Completed') DEFAULT 'Created'");
            $table->string('vialBarcode')->nullable()->unique()->after('status');
            $table->timestamp('collectedAt')->nullable()->after('vialBarcode');
            $table->foreignId('collectedBy')->nullable()->constrained('users')->nullOnDelete()->after('collectedAt');
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
