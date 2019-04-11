<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deposit_name');
            $table->timestamps();
        });

        Schema::table('invoices', function($table){
            $table->unsignedInteger('deposit_id');
            $table->foreign('deposit_id')->
                references('id')->
                on('deposits')->
                onDelete('no action');       
        });
        Schema::table('inventories', function($table){
            $table->unsignedInteger('deposit_id');
            $table->foreign('deposit_id')->
                references('id')->
                on('deposits')->
                onDelete('no action');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
