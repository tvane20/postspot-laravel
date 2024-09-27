<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('content'); // Ajoute la colonne category_id
            
            // Si tu veux ajouter une contrainte de clé étrangère
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Supprime la contrainte de clé étrangère si elle existe
            $table->dropColumn('category_id'); // Supprime la colonne category_id
        });
    }
}

