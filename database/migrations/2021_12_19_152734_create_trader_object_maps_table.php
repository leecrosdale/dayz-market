<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraderObjectMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader_object_maps', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('area');
            $table->foreignId('dayz_object_id')->constrained();
            $table->float('x', 15, 6);
            $table->float('y', 15, 6);
            $table->float('z', 15, 6);
            $table->float('yaw', 15, 6);
            $table->float('pitch', 15, 6);
            $table->float('roll', 15, 6);
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
        Schema::dropIfExists('trader_object_maps');
    }
}
