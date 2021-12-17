<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_type_id')->constrained();
            $table->string('class_name');
            $table->integer('max_price_threshold');
            $table->integer('min_price_threshold');
            $table->integer('sell_price_percent');
            $table->integer('max_stock_threshold');
            $table->integer('min_stock_threshold');
            $table->json('spawn_attachments');
            $table->json('variants');
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
        Schema::dropIfExists('items');
    }
}
