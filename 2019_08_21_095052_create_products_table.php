<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->enum('category',array('men','women','others'));
            $table->string('sku')->nullable();
            $table->integer('stock')->nullable();
            $table->double('price', 10, 2)->nullable();
            $table->string('images')->nullable();
            $table->text('barcode')->nullable();
            $table->double('tax', 10, 2)->nullable();
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
        Schema::dropIfExists('products');
    }
}
