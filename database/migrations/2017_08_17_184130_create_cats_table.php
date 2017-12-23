<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('breed')->nullable();
            $table->string('name')->nullable();
            $table->string('color');
            $table->string('date_of_birth')->nullable();
            $table->boolean('is_male')->default(true);
            $table->string('status');

            $table->date('registration_date')->nullable();
            $table->date('leave_date')->nullable();

            $table->boolean('is_castrated')->default(false);
            $table->date('castration_date')->nullable();

            $table->date('first_vaccination')->nullable();
            $table->date('second_vaccination')->nullable();
            $table->date('next_vaccination')->nullable();

            $table->string('tattoo_left', 5)->nullable();
            $table->string('tattoo_right', 5)->nullable();
            $table->integer('chip')->nullable();

            $table->text('distinguishing_marks')->nullable();
            $table->text('comments')->nullable();

            $table->boolean('deceased')->default(false);
            $table->string('cause_of_death')->nullable();

            $table->boolean('is_indoor_cat')->default(true);
            $table->boolean('is_outdoor_cat')->default(true);
            $table->boolean('is_cat_friendly')->default(true);
            $table->boolean('is_dog_friendly')->default(true);
            $table->boolean('is_child_friendly')->default(true);

            $table->string('photo_path')->nullable();

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
        Schema::dropIfExists('cats');
    }
}
