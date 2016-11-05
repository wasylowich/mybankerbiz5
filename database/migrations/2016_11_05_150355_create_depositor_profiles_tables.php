<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositorProfilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositor_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('depositor_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('depositor_type_id')->unsigned();
            $table->string('name', 255);
            $table->string('vatin', 20)->nullable();
            $table->string('pin', 20)->nullable();
            $table->boolean('is_primary')->default(true);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('depositor_type_id')->references('id')->on('depositor_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('depositor_profiles');
        Schema::drop('depositor_types');
    }
}
