<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDronesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drones', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number', 100)->unique();
            $table->string('model', 50)->default("Lightweight");
            $table->float('weight_limit')->default(0);
            $table->integer('battery_capacity')->default(0);
            $table->string('state', 50)->default('IDLE');
            $table->timestamps();
        });

        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); 
            $table->float('weight')->default(0);
            $table->string('code', 255); // no ImageField yet
            $table->integer('drones_id')->unsigned();
            $table->foreign('drones_id')->nullable()->references('id')->on('drones');
            $table->timestamps();
        });
        
        Schema::create('battery_level_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('drones_id')->unsigned();
            $table->foreign('drones_id')->nullable()->references('id')->on('drones');
            $table->string('serial_number', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->integer('battery_level')->default(0);
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
        Schema::dropIfExists('medication');
        Schema::dropIfExists('battery_level_logs');
        Schema::dropIfExists('drones');
    }
}
