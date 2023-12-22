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
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->references('id')->on('vendors')->cascadeOnDelete();
            $table->enum('type',['Cash','Online','Check','Concession']);
            $table->string('online_type')->nullable();
            $table->integer('bank_id')->nullable();
            $table->integer('account_id')->nullable();
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
        Schema::dropIfExists('purchase_payments');
    }
};
