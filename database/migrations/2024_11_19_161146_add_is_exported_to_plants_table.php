<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->boolean('is_exported')->default(false); // Tracks export status
            $table->timestamp('exported_at')->nullable(); // Tracks the export date
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plants', function (Blueprint $table) {
            //
        });
    }
};
