<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoingrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_number');
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
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->
                    references('id')->
                    on('products')->
                    onDelete('no action');
            $table->unsignedInteger('costcenter_id');
            $table->foreign('costcenter_id')->
                    references('id')->
                    on('costcenters')->
                    onDelete('no action');        
             $table->double('request_itemvalue');    
             $table->double('request_itemquantitity');
             $table->double('request_movquantity'); 
             $table->double('request_movvalue');
             $table->string('request_observation');   
             $table->date('inventory_datemov');          
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
        Schema::dropIfExists('requests');
    }
}
