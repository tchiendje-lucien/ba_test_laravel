<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->integer('ID_PUBLICATION', true);
            $table->integer('ID_USER')->index('I_FK_PUBLICATIONS_USERS');
            $table->integer('ID_PRODUIT')->index('I_FK_PUBLICATIONS_PRODUITS');
            $table->boolean('ETAT_PUB');
            $table->dateTime('DATE_PUB');
            $table->dateTime('DATE_MODIF_PUB', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
}
