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
            $table->foreignId('address_id')->nullable();
            $table->foreignId('superkitchen_by')->nullable();
            $table->foreignId('superdelivery_by')->nullable();
            $table->foreignId('delivery_by')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->string('status_order_complete')->default(0);
            $table->enum('status_paid',[0,1])->default(0);
            $table->enum('status',['Pending','Processing','EndProcessing','Delivery','Completed'])->default('Pending');
            $table->enum('type',['Delivery','Takeaway','Inrestaurant']);
            $table->decimal('total_price');
            $table->integer('discount')->default(0);
            $table->enum('payment_type',['cash','online','cashondelivery']);
            $table->string('payment_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('note_for_driver')->nullable();
            $table->dateTime('delivery_start')->nullable();
            $table->dateTime('delivery_end')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('delivery_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('superkitchen_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('superdelivery_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
