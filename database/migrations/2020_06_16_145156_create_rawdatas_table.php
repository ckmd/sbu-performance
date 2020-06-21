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
            $table->text('Ticket ID');
            $table->bigInteger('Incident ID');
            $table->text('Service ID');
            $table->text('Customer');
            $table->text('Region SBU (Terminating) (Address)');
            $table->dateTime('Created On', 0);
            $table->dateTime('Close Date', 0);
            $table->dateTime('Interference Time', 0);
            $table->text('Service ID Status');
            $table->text('Product');
            $table->text('Interference Cause (Incident ID) (Incident)')->nullable()->default(NULL);
            $table->text('Address (Terminating) (Address)')->nullable()->default(NULL);
            $table->text('Province (Terminating) (Address)')->nullable()->default(NULL);
            $table->text('State (Terminating) (Address)')->nullable()->default(NULL);
            $table->text('Bandwidth')->nullable()->default(NULL);
            $table->text('Address')->nullable()->default(NULL);
            $table->integer('Stop Clock Duration')->nullable()->default(NULL);
            $table->text('Ticket Type')->nullable()->default(NULL);
            $table->text('Interference (Incident ID) (Incident)')->nullable()->default(NULL);
            $table->integer('Interference Net Duration (DurationId) (Duration)')->nullable()->default(NULL);
            $table->text('Interference Location (Incident ID) (Incident)')->nullable()->default(NULL);
            $table->text('Summary Problem')->nullable()->default(NULL);
            $table->text('SBU Owner (Activation List Number) (Activation List)')->nullable()->default(NULL);
            $table->text('Customer Group')->nullable()->default(NULL);
            $table->text('Description (Customer Segment) (Segment)')->nullable()->default(NULL);
            $table->text('Team Issue')->nullable()->default(NULL);
            $table->integer('Total Amount (Activation List Number) (Activation List)')->nullable()->default(NULL);
            $table->text('Status Reason')->nullable()->default(NULL);
            $table->text('Status')->nullable()->default(NULL);
            $table->text('Bulan');
            $table->integer('Minggu');
            $table->text('Hari');
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
