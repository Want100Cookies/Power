<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsmrTelegramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsmr_telegrams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meter_id');

            $table->decimal('total_usage_high_tariff', 9, 3);
            $table->decimal('total_usage_low_tariff', 9, 3);
            $table->decimal('total_yield_high_tariff', 9, 3);
            $table->decimal('total_yield_low_tariff', 9, 3);

            $table->tinyInteger('current_tariff');

            $table->decimal('current_usage', 6, 3);
            $table->decimal('current_yield', 6, 3);

            $table->decimal('gas_total', 8, 3);
            $table->dateTime('gas_send_at');
            $table->dateTime('send_at');
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
        Schema::dropIfExists('dsmr_telegrams');
    }
}
