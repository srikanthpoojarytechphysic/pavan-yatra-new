<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flightbookings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('user_id');
            $table->string('reference_no');
            $table->string('GDFPNRNo');
            $table->string('EticketNo');
            $table->string('BookingStatus');
            $table->string('TransactionId');
            $table->string('onwardflightnumber');
            $table->string('onwardpax');
            $table->string('returnflightnumber')->nullable();
            $table->string('returnpax')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flightbookings');
    }
}
