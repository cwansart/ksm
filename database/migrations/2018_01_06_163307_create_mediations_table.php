<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->nullable();

            $table->string('firstname');
            $table->string('lastname');
            $table->text('location'); // not equivalent with a Location object since this needs to be unique.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediations');
    }
}
