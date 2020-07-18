<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_quote_id')->unsigned()->nullable();
            $table->string('operation_code', 250)->nullable();
            $table->dateTime('operation_date', 6)->nullable();
            $table->integer('shipper_id')->unsigned()->nullable();
            $table->integer('consignee_id')->unsigned()->nullable();
            $table->integer('notify_id')->unsigned()->nullable();
            $table->integer('import_export_flag')->nullable();
            $table->text('container_counts')->nullable();
            $table->string('container_name', 250)->nullable();
            $table->string('pl_no', 250)->nullable();
            $table->dateTime('loading_date', 6)->nullable();
            $table->dateTime('arrival_date', 6)->nullable();
            $table->string('vassel_name', 250)->nullable();
            $table->string('booking_no', 250)->nullable();
            $table->integer('commodity_id')->unsigned()->nullable();
            $table->dateTime('cut_off_date', 6)->nullable();
            $table->integer('sales_quote_ocean_id')->unsigned()->nullable();
            $table->integer('sales_quote_air_id')->unsigned()->nullable();
            $table->integer('sales_quote_tracking_id')->unsigned()->nullable();
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
        Schema::dropIfExists('operations');
    }
}
