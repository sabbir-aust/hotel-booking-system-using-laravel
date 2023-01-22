<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('room_id');
            $table->integer('total_rooms');
            $table->string('checkin_date');
            $table->string('checkout_date');
            $table->string('checkin_time');
            $table->string('total_person');
            $table->string('ref');
            $table->string('status');
            $table->decimal('total_price', 12,2);
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
        Schema::dropIfExists('bookings');
    }
};
