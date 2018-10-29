<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id');
            $table->integer('payment_id');
            $table->integer('total_no_of_meditations');
            $table->integer('remaining_no_of_meditations')->default(0);
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
        Schema::dropIfExists('domain_payments');
    }
}
