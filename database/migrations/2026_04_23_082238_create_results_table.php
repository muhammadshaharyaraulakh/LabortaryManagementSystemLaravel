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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('trackingId')->index();
            $table->text('resultValue')->nullable();
            $table->json('attachmentPaths')->nullable();
            $table->string('statusFlag')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('orderTestId')->constrained('order_test')->onDelete('cascade');
            $table->foreignId('testParameterId')->nullable()->constrained('test_parameters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
