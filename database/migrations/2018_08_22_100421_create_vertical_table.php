<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerticalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verticals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vertical_name');
            $table->timestamps();
        });

        
        Schema::table('costcenters', function($table){
            $table->unsignedInteger('vertical_id');
            $table->foreign('vertical_id')->
                references('id')->
                on('verticals')->
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
        Schema::dropIfExists('verticals');
    }
}
