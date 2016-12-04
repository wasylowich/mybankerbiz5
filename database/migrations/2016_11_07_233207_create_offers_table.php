<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id')->unsigned();
            $table->integer('bidder_id')->unsigned()->nullable();
            $table->integer('enquiry_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('offer_chance_id')->unsigned();

            $table->integer('interest_convention_id')->unsigned();
            $table->integer('interest_term_id')->unsigned();
            $table->integer('fixation_period_months')->unsigned()->nullable();
            $table->timestamp('deadline')->nullable();
            $table->decimal('interest', 8, 4);
            $table->decimal('amount', 16, 4);

            $table->enum('state', ['active','accepted','cancelled','rejected','archived'])->default('active');

            $table->timestamp('archived_at')->nullable();
            $table->string('archiver_role', 255)->nullable();
            $table->integer('archiver_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('bidder_id')->references('id')->on('users');
            $table->foreign('enquiry_id')->references('id')->on('enquiries');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('offer_chance_id')->references('id')->on('offer_chances');
            $table->foreign('interest_convention_id')->references('id')->on('interest_conventions');
            $table->foreign('interest_term_id')->references('id')->on('interest_terms');
            $table->foreign('archiver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offers');
    }
}
