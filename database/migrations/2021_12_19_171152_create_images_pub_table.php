<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesPubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_pub', function (Blueprint $table) {
            $table->integer('ID_IMAGE', true);
            $table->integer('ID_PUBLICATION')->index('I_FK_IMAGES_PUB_PUBLICATIONS');
            $table->char('LIBELLE_IMAGE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_pub');
    }
}
