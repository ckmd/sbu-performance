<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawdatas', function (Blueprint $table) {
            $table->id();
            $table->text('ticket_id');
            $table->bigInteger('incident_id');
            $table->text('service_id');
            $table->text('customer');
            $table->text('region_sbu');
            $table->dateTime('created_on', 0);
            $table->double('interference_net_duration',8,2)->nullable()->default(NULL);
            $table->text('product');
            $table->text('interference')->nullable()->default(NULL);
            $table->text('month');
            $table->integer('week');
            $table->text('day');
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
        Schema::dropIfExists('rawdatas');
    }
}
