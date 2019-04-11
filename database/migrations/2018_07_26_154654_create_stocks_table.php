<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_cod')->unique();
            $table->string('project_name')->unique();
        });

        Schema::create('business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name')->unique();
        });

        Schema::create('clientgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clientegroup_name')->unique();
        });

        Schema::create('resultcenters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resultcenter_name')->unique();
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('area_name')->unique();
        });
        Schema::create('costcenters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('costcenter_cod')->unique();
            $table->string('costcenter_description')->unique();
            $table->string('costcenter_businessowner');
            $table->string('costcenter_ccowner');
            $table->unsignedInteger('business_id');
            $table->foreign('business_id')->
                references('id')->
                on('business')->
                onDelete('no action');
            $table->unsignedInteger('clientgroups_id');
            $table->foreign('clientgroups_id')->
                references('id')->
                on('clientgroups')->
                onDelete('no action');
            $table->unsignedInteger('resultcenter_id');
            $table->foreign('resultcenter_id')->
                references('id')->
                on('resultcenters')->
                onDelete('no action');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->
                references('id')->
                on('projects')->
                onDelete('no action');    
            $table->unsignedInteger('area_id');
            $table->foreign('area_id')->
                references('id')->
                on('areas')->
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
     
        Schema::dropIfExists('projects');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('clientgroups');
        Schema::dropIfExists('resultcenters');
        Schema::dropIfExists('costcenters');
    }
}
