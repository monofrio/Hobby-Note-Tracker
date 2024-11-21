<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->string('batch_number')->default('')->after('start_type');
            $table->integer('batch_plant_number')->default(0)->after('batch_number');
        });
    }

    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn('batch_number');
            $table->dropColumn('batch_plant_number');
        });
    }
};
