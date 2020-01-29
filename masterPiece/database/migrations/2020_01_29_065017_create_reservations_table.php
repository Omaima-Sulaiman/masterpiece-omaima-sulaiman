<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
    $table->boolean('is_booking')->default(false);
    $table->dateTime('booking_start_at');
    $table->dateTime('booking_end_at');
    $table->unsignedInteger('post_id');
    $table->unsignedInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('reservations');
    }
}
