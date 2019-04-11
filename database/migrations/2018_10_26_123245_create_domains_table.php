<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain_name');
            $table->string('domain_holder');
            $table->string('domain_owner ');
            $table->string('domain_technicalcontact');
            $table->string('domain_billingcontact');
            $table->string('domain_createdat');
            $table->string('domain_expireat');
            $table->string('domain_updatedat');
            $table->string('domain_status');
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
        Schema::dropIfExists('domains');
    }
}
