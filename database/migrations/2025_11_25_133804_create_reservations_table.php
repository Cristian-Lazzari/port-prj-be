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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('boat_id');

            // 👇 unica modifica reale
            $table->unsignedBigInteger('slot_id')->nullable();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table->foreign('boat_id')
                ->references('id')
                ->on('boats')
                ->onDelete('cascade');

            // 👇 cambia solo la delete rule
            $table->foreign('slot_id')
                ->references('id')
                ->on('slots')
                ->onDelete('set null');

            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->string('status')->default('1');
            // 1 ricevuta, 2 acconto, 3 pagata, 0 cancellata

            $table->string('message')->nullable();

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
