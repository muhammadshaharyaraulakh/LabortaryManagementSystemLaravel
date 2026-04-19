<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testId')->constrained('tests', 'id')->onDelete('cascade');
            $table->foreignId('inventoryId')->constrained('inventories', 'id')->onDelete('cascade');
            $table->decimal('quantityUsed', 8, 2)->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_requirements');
    }
};