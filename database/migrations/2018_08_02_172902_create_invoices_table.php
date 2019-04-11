<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_number');
            $table->string('invoice_type');
            $table->unsignedInteger('reseller_id');
            $table->foreign('reseller_id')->
                references('id')->
                on('resellers')->
                onDelete('no action');
            $table->unsignedInteger('area_id');
            $table->foreign('area_id')->
                references('id')->
                on('areas')->
                onDelete('no action');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->
                references('id')->
                on('projects')->
                onDelete('no action');
            $table->unsignedInteger('costcenter_id');
            $table->foreign('costcenter_id')->
                references('id')->
                on('costcenters')->
                onDelete('no action');
            $table->string('invoice_owner');
            $table->string('invoice_ctafin');
            $table->string('invoice_ctacon');
            $table->date('invoice_billingdate');
            $table->date('invoice_duedate');

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
           $table->double('invoice_itemvalue');    
           $table->double('invoice_itemquantitity');   
           $table->timestamps();
        });

        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
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
            $table->unsignedInteger('invoice_number');
            $table->foreign('invoice_number')->
                    references('invoice_number')->
                    on('invoices')->
                    onDelete('no action');       
            $table->double('inventory_itemvalue');    
            $table->double('inventory_itemquantitity');
            $table->double('inventory_typemov');   
            $table->double('inventory_movquantity'); 
            $table->double('inventory_movvalue');
            $table->double('inventory_observation');   
            $table->date('inventory_datemov');                       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('inventories');
    }
}
