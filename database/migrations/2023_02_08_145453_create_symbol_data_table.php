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
        Schema::create('symbol_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('symbol_id');
            $table->double('mid', 10, 2);
            $table->double('bid', 10, 2);
            $table->double('ask', 10, 2);
            $table->double('last_price', 10, 2);
            $table->double('low', 10, 2);
            $table->double('high', 10, 2);
            $table->double('volume', 16, 6);
            $table->timestamp('timestamp');
            $table->timestamps();
            $table->foreign('symbol_id')->references('id')->on('symbols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('symbol_data');
    }
};
