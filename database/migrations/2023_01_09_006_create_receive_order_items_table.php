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
        Schema::create('receive_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('receive_orders')->cascadeOnDelete();
            $table->foreignId('sale_item_id')->references('id')->on('sale_items')->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('rate',10,2);
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
        Schema::dropIfExists('receive_order_items');
    }
};
