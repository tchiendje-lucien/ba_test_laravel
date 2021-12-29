<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('ID_USER', true);
            $table->string('EMAIL');
            $table->string('PASSWORD');
            $table->string('FULL_NAME');
            $table->integer('ETAT_USER');
            $table->text('PHOTO_USER')->nullable();
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
        Schema::dropIfExists('users');
    }
}
