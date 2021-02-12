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
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status',['Pending','Shipped','Delivered','Processing'])->default('Pending');
            $table->enum('type',['delivery','takeaway','inrestaurant']);
            $table->dateTime('delivery_time')->nullable();
            $table->decimal('total_price');
            $table->integer('discount')->default(0);
            $table->enum('payment_type',['cash','online']);
            $table->string('payment_id')->nullable();
            $table->string('phone_number')->nullable();
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
