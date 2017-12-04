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
