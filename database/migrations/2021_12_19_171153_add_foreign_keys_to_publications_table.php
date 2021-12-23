<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->foreign(['ID_USER'], 'FK_PUBLICATIONS_USERS')->references(['ID_USER'])->on('users');
            $table->foreign(['ID_PRODUIT'], 'FK_PUBLICATIONS_PRODUITS')->references(['ID_PRODUIT'])->on('produits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropForeign('FK_PUBLICATIONS_USERS');
            $table->dropForeign('FK_PUBLICATIONS_PRODUITS');
        });
    }
}
