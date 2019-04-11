<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('license_name');
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->
                references('id')->
                on('brands')->
                onDelete('no action');
            $table->string('license_version');
            $table->unsignedInteger('area_id');
            $table->foreign('area_id')->
                references('id')->
                on('areas')->
                onDelete('no action');
            $table->string('license_keyuser');
            $table->string('license_maintainer');
            $table->string('license_integrations');
            $table->string('license_dbacess');
            $table->integer('license_qty');
            $table->string('license_type');
            $table->string('license_server');
            $table->string('license_totalvalue');
            $table->string('license_supportcontact');
            $table->string('license_observation');
            $table->timestamps();
        });
        Schema::create('attachments_licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attachment_name');
            $table->string('attachment_path');
            $table->unsignedInteger('license_id');
            $table->foreign('license_id')->
            references('id')->
            on('licenses')->
            onDelete('no action');
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
        Schema::dropIfExists('licenses');
    }
}
