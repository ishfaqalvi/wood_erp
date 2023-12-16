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
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->enum('type',['Cash','Online','Check','Concession']);
            $table->integer('bank')->nullable();
            $table->string('slip_number')->nullable();
            $table->string('check_number')->nullable();
            $table->string('attachment')->nullable();
            $table->string('remarks')->nullable();
            $table->bigInteger('date');
            $table->decimal('amount',10,2)->default(0);
            $table->enum('status',['Pending','Approved'])->default('Pending');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_payments');
    }
};
