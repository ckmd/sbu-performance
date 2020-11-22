<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excels', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('ar_id');
            $table->bigInteger('prob_id');
            $table->bigInteger('kode_wo');
            $table->string('region');
            $table->string('basecamp');
            $table->string('serpo');
            $table->datetime('wo_date');
            $table->datetime('wo_complete')->nullable()->default(NULL);
            $table->decimal('durasi_sbu',10,2)->nullable()->default(NULL);
            $table->decimal('prep_time',10,2)->nullable()->default(NULL);
            $table->decimal('travel_time',10,2)->nullable()->default(NULL);
            $table->decimal('work_time',10,2)->nullable()->default(NULL);
            $table->decimal('rsps',10,4);
            $table->decimal('total_durasi_serpo',10,2)->nullable()->default(NULL);
            $table->decimal('total_durasi_wo',10,2)->nullable()->default(NULL);
            $table->longtext('total_durasi_sc')->nullable()->default(NULL);
            $table->longtext('category')->nullable()->default(NULL);
            $table->longtext('root_cause')->nullable()->default(NULL);
            $table->longtext('kendala')->nullable()->default(NULL);
            $table->longtext('terminasi_pop')->nullable()->default(NULL);
            $table->longtext('root_cause_description')->nullable()->default(NULL);
            $table->longtext('kendala_description')->nullable()->default(NULL);
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
        Schema::dropIfExists('excels');
    }
}
