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
        Schema::table('tests', function (Blueprint $table) {
            $table->text('Instructions(SampleCollector)')->nullable()->after('instructions');
            $table->unsignedBigInteger('deleted_by')->nullable()->after('userId');
            $table->unsignedBigInteger('edited_by')->nullable()->after('deleted_by');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn([
                'Instructions(SampleCollector)',
                'deleted_by',
                'edited_by'
            ]);
            $table->dropSoftDeletes();
        });
    }
};