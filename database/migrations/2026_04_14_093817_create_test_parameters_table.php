<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_parameters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('testId')->constrained('tests', 'id')->onDelete('cascade');

            $table->string('parameterName');
            $table->string('unit')->nullable();
            $table->string('normalRange')->nullable();
            $table->string('inputType')->default('number');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_parameters');
    }
};