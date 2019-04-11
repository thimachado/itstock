<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name')->unique();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name')->unique();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_model')->unique();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->
                references('id')->
                on('categories')->
                onDelete('no action');
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->
                    references('id')->
                    on('brands')->
                    onDelete('no action');
            $table->timestamps();       
        });

        Schema::create('resellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reseller_name')->unique();
            $table->string('reseller_site');
            $table->string('reseller_email');
        });
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deposit_name')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('resellers');
        Schema::dropIfExists('deposits');
    }
}
