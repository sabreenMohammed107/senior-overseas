<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name',250)->nullable();
            $table->string('contact_person',250)->nullable();
            $table->string('phone',250)->nullable();
            $table->string('mobile',250)->nullable();
            $table->string('email',250)->nullable();
            $table->string('address',250)->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('client_document',1000)->nullable();
         
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
        Schema::dropIfExists('clients');
    }
}
