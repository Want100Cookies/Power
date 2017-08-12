<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePvTelegramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pv_telegrams', function (Blueprint $table) {
            $table->increments('id');

            $table->string('inverter_id');
            $table->decimal('temperature', 7, 2);

            $table->decimal('vpv1', 7, 2);
            $table->decimal('vpv2', 7, 2);
            $table->decimal('vpv3', 7, 2);

            $table->decimal('ipv1', 7, 2);
            $table->decimal('ipv2', 7, 2);
            $table->decimal('ipv3', 7, 2);

            $table->decimal('iac1', 7, 2);
            $table->decimal('iac2', 7, 2);
            $table->decimal('iac3', 7, 2);

            $table->decimal('vac1', 7, 2);
            $table->decimal('vac2', 7, 2);
            $table->decimal('vac3', 7, 2);

            $table->decimal('fac1', 7, 2);
            $table->decimal('fac2', 7, 2);
            $table->decimal('fac3', 7, 2);

            $table->decimal('pac1', 7, 2);
            $table->decimal('pac2', 7, 2);
            $table->decimal('pac3', 7, 2);

            $table->decimal('total_day', 9, 2);
            $table->decimal('total', 65, 1);

            $table->decimal('hours_since_reset', 9, 1);

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
        Schema::dropIfExists('pv_telegrams');
    }
}
