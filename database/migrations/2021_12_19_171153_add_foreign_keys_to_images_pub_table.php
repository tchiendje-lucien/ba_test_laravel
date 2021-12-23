<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToImagesPubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images_pub', function (Blueprint $table) {
            $table->foreign(['ID_PUBLICATION'], 'FK_IMAGES_PUB_PUBLICATIONS')->references(['ID_PUBLICATION'])->on('publications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images_pub', function (Blueprint $table) {
            $table->dropForeign('FK_IMAGES_PUB_PUBLICATIONS');
        });
    }
}
