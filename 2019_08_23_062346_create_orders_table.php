<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->double('sub_total', 10, 2)->nullable();
            $table->double('tax_total', 10, 2)->nullable();
            $table->double('total_discount', 10, 2)->nullable();
            $table->double('total_price', 10, 2)->nullable();
            $table->double('given_price', 10, 2)->nullable();
            $table->double('change', 10, 2)->nullable();
            $table->text('address')->nullable();
            $table->enum('status',array('active','inactive'))->default('active');
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
