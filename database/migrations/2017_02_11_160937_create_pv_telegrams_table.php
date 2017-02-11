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
            $table->decimal('temperature', 3, 1);

            $table->decimal('vpv1', 4, 2);
            $table->decimal('vpv2', 4, 2);
            $table->decimal('vpv3', 4, 2);

            $table->decimal('ipv1', 4, 2);
            $table->decimal('ipv2', 4, 2);
            $table->decimal('ipv3', 4, 2);

            $table->decimal('iac1', 4, 2);
            $table->decimal('iac2', 4, 2);
            $table->decimal('iac3', 4, 2);

            $table->decimal('vac1', 4, 2);
            $table->decimal('vac2', 4, 2);
            $table->decimal('vac3', 4, 2);

            $table->decimal('fac1', 4, 2);
            $table->decimal('fac2', 4, 2);
            $table->decimal('fac3', 4, 2);

            $table->decimal('pac1', 4, 2);
            $table->decimal('pac2', 4, 2);
            $table->decimal('pac3', 4, 2);

            $table->decimal('total_day', 4, 2);
            $table->decimal('total', 65, 1);

            $table->decimal('hours_since_reset', 4, 1);

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
