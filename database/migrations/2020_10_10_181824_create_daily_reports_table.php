<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->text('ticket_id');
            $table->bigInteger('incident_id')->nullable()->default(NULL);
            $table->dateTime('interference_time', 0)->nullable()->default(NULL);
            $table->text('region_sbu')->nullable()->default(NULL);
            $table->text('service_id')->nullable()->default(NULL);
            $table->text('customer')->nullable()->default(NULL);
            $table->text('product')->nullable()->default(NULL);
            $table->text('address_terminating')->nullable()->default(NULL);
            $table->text('summary_problem')->nullable()->default(NULL);
            $table->text('status_reason')->nullable()->default(NULL);
            $table->text('team_issue')->nullable()->default(NULL);
            $table->integer('stop_clock_duration')->nullable()->default(NULL);
            $table->dateTime('created_on', 0);
            $table->dateTime('close_date', 0)->nullable()->default(NULL);
            $table->integer('interference_net_duration')->nullable()->default(NULL);
            $table->text('address')->nullable()->default(NULL);
            $table->text('province')->nullable()->default(NULL);
            $table->text('state')->nullable()->default(NULL);
            $table->integer('total_amount')->nullable()->default(NULL);
            $table->text('service_id_status')->nullable()->default(NULL);
            $table->text('bandwidth')->nullable()->default(NULL);
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_reports');
    }
}
