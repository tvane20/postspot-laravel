<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    if (!Schema::hasColumn('posts', 'user_id')) {
    Schema::table('posts', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained()->after('id')->nullable(); // Ajoutez cette ligne
    });
    }
}

public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
