<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpkoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spko_items', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('ordinal');
            $table->integer('qty');
            $table->unsignedBigInteger('id_product');
            $table->primary(['id', 'ordinal']);
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
        Schema::dropIfExists('spko_items');
    }
}
