<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 255)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('interest_conventions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('convention', 255)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('interest_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('term', 255)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rebate_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 255)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->integer('bank_type_id')->unsigned();
            $table->integer('interest_convention_id')->unsigned();
            $table->integer('interest_term_id')->unsigned();
            $table->integer('pension_interest_convention_id')->unsigned();
            $table->integer('rebate_type_id')->unsigned();
            $table->string('name', 255);
            $table->string('vatin', 20);
            $table->string('website')->nullable();
            $table->boolean('change_of_control')->default(false);
            $table->text('rebate_message')->nullable();
            $table->boolean('is_active')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('bank_type_id')->references('id')->on('bank_types');
            $table->foreign('interest_convention_id')->references('id')->on('interest_conventions');
            $table->foreign('interest_term_id')->references('id')->on('interest_terms');
            $table->foreign('pension_interest_convention_id')->references('id')->on('interest_conventions');
            $table->foreign('rebate_type_id')->references('id')->on('rebate_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banks');
        Schema::drop('rebate_types');
        Schema::drop('interest_terms');
        Schema::drop('interest_conventions');
        Schema::drop('bank_types');
    }
}
