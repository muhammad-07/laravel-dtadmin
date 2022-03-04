<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->varchar('name');
            $table->varchar('description')->nullable();
            $table->varchar('details')->nullable();
            $table->varchar('features')->nullable();
            $table->integer('price');
            $table->integer('category_id');
            $table->text('photos')->nullable();
            $table->varchar('extras')->nullable();
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
        Schema::drop('products');
    }
}
