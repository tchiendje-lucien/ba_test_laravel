<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->integer('ID_PRODUIT', true);
            $table->string('NOM_PROD', 128);
            $table->decimal('PRIX_PROD', 10);
            $table->text('DESC_PRODUIT')->nullable();
            $table->boolean('ETAT_STOCK');
            $table->dateTime('DATE_CREATE');
            $table->dateTime('DATE_UPDATE')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
