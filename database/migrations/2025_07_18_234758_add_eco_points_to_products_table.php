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
    Schema::table('products', function (Blueprint $table) {
        $table->integer('eco_points')->default(0); // default = 0 for non-green items
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('eco_points');
    });
}

};
