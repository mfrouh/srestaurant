<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status',['Pending','Shipped','Delivered','Processing']);
            $table->dateTime('delivery_time')->nullable();
            $table->decimal('total_price');
            $table->integer('discount');
            $table->string('payment_id');
            $table->string('address');
            $table->string('street');
            $table->string('phone_number');
            $table->string('note_for_driver')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
