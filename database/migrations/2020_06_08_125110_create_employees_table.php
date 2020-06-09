<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_name',250)->nullable();
            $table->string('national_id',250)->nullable();
            $table->string('phone',250)->nullable();
            $table->string('mobile',250)->nullable();
            $table->string('mobile2',250)->nullable();
            $table->string('position',250)->nullable();
            $table->string('salary',250)->nullable();
            $table->string('address',250)->nullable();
            $table->text('employee_document')->nullable();
            $table->text('notes')->nullable();
          
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
        Schema::dropIfExists('employees');
    }
}
