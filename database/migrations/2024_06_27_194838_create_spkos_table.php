<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpkosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spkos', function (Blueprint $table) {
            $table->id();
            $table->text('remarks');
            $table->date('trans_date');
            $table->string('process', 10);
            $table->string('sw', 25);
            $table->unsignedBigInteger('employee');
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
        Schema::dropIfExists('spkos');
    }
}
