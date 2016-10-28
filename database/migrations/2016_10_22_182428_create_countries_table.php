<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('default_currency_id')->unsigned();
            $table->string('name', 255);
            $table->string('local_short_form', 255);
            $table->string('abbreviation', 50);
            $table->char('iso_alpha_2', 2);
            $table->char('iso_alpha_3', 3);
            $table->string('telephone_code', 10);
            $table->string('tld', 6);
            $table->boolean('is_enabled')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('default_currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('countries');
    }
}
