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
    Schema::table('seats', function (Blueprint $table) {
        $table->string('from');
        $table->string('to');
        $table->date('travel_date');
    });
}

public function down()
{
    Schema::table('seats', function (Blueprint $table) {
        $table->dropColumn(['from', 'to', 'travel_date']);
    });
}

};
