<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferChancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_chances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id')->unsigned();
            $table->integer('bidder_id')->unsigned()->nullable();
            $table->integer('enquiry_id')->unsigned();

            $table->enum('state', ['under_consideration', 'accepted', 'declined', 'lost_to_competitor', 'cancelled_by_customer', 'expired'])->default('under_consideration');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('bidder_id')->references('id')->on('users');
            $table->foreign('enquiry_id')->references('id')->on('enquiries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offer_chances');
    }
}
