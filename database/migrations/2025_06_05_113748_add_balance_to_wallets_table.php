<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('wallets', function (Blueprint $table) {
        $table->decimal('balance', 10, 2)->default(0)->after('user_id');
    });
}

public function down(): void
{
    Schema::table('wallets', function (Blueprint $table) {
        $table->dropColumn('balance');
    });
}
};
