<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->integer('postal_code_id')->unsigned();
            $table->integer('addressable_id')->unsigned();
            $table->string('addressable_type', 255);
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('address3', 255)->nullable();
            $table->decimal('lng', 12, 10)->nullable();
            $table->decimal('lat', 12, 10)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('postal_code_id')->references('id')->on('postal_codes');

            $table->index(['addressable_id', 'addressable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
