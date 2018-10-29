<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeditationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meditations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('room');

            $table->integer('domain_id')->unsigned();
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');

            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');

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
        Schema::dropIfExists('meditations');
    }
}
