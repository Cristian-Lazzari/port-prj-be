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
        Schema::create('boats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->onDelete('cascade');

            $table->string('name', 50);
            $table->mediumInteger('loa');
            $table->mediumInteger('draft');
            $table->mediumInteger('beam');
            $table->string('model');//barca a motore, vela , gommone
            $table->string('type', 2);//barca a motore, vela , gommone
            $table->string('serial_code', 50);

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
        Schema::dropIfExists('boats');
    }
};
