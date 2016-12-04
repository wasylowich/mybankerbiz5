<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquirer_id')->unsigned();
            $table->integer('depositor_profile_id')->unsigned();
            $table->integer('deposit_type_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->timestamp('bidding_deadline')->nullable();
            $table->bigInteger('amount');
            $table->date('fixation_period_start_date')->nullable();
            $table->date('fixation_period_end_date')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamp('archived_at')->nullable();
            $table->string('archiver_role', 255)->nullable();
            $table->integer('archiver_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('enquirer_id')->references('id')->on('users');
            $table->foreign('depositor_profile_id')->references('id')->on('depositor_profiles');
            $table->foreign('deposit_type_id')->references('id')->on('deposit_types');
            $table->foreign('currency_id')->references('id')->on('currencies');
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
        Schema::drop('enquiries');
        Schema::drop('deposit_types');
    }
}
