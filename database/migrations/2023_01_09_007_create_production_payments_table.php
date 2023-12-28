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
        Schema::create('production_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->foreignId('worker_id')->references('id')->on('workers')->cascadeOnDelete();
            $table->enum('type',['Cash','Online','Check']);
            $table->integer('bank')->nullable();
            $table->string('slip_number')->nullable();
            $table->string('check_number')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('production_payments');
    }
};
