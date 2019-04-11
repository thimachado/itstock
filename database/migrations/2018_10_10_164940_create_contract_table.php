<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->timestamps();
        });

        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attachment_name');
            $table->string('attachment_path');
            $table->timestamps();
        });
        Schema::create('indexreadjustments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('index_name');
            $table->timestamps();
        });

        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_number');
            $table->string('contract_internal');
            $table->unsignedInteger('reseller_id');
            $table->foreign('reseller_id')->
            references('id')->
            on('resellers')->
            onDelete('no action');
            $table->string('contract_title');
            $table->unsignedInteger('contractcategory_id');
            $table->foreign('contractcategory_id')->
            references('id')->
            on('contractcategories')->
            onDelete('no action');
            $table->string('contract_type');
            $table->string('contract_startdate');
            $table->string('contract_expirationdate');
            $table->string('contract_warningdate');
            $table->string('contract_paytype');
            $table->string('contract_totalvalue');
            $table->string('contract_qtdparcelas');
            $table->string('contract_ultimaparcela');
            $table->string('contract_objectdescription');
            $table->string('contract_releasedescription');
            $table->string('contract_area');
            $table->unsignedInteger('index_id');
            $table->foreign('index_id')->
            references('id')->
            on('indexreadjustments')->
            onDelete('no action');
            $table->string('contract_indexpercentage'); 
            $table->string('contract_anualreadjust'); 
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
        Schema::dropIfExists('contract');
    }
}
