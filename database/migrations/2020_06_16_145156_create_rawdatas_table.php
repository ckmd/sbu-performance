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
            $table->string('Ticket ID');
            $table->bigInteger('Incident ID');
            $table->bigInteger('Service ID');
            $table->string('Customer');
            $table->string('Region SBU (Terminating) (Address)');
            $table->dateTime('Created On', 0);
            $table->dateTime('Close Date', 0);
            $table->dateTime('Interference Time', 0);
            // $table->string('Service ID Status');
            // $table->string('Product');
            // $table->string('Interference Cause (Incident ID) (Incident)');
            // $table->string('Address (Terminating) (Address)');
            // $table->string('Province (Terminating) (Address)');
            // $table->string('State (Terminating) (Address)');
            // $table->string('Bandwidth');
            // $table->string('Address');
            // $table->integer('Stop Clock Duration');
            // $table->string('Ticket Type');
            // $table->string('Interference (Incident ID) (Incident)')->nullable()->default(NULL);
            // $table->integer('Interference Net Duration (DurationId) (Duration)');
            // $table->string('Interference Location (Incident ID) (Incident)')->nullable()->default(NULL);
            // $table->string('Summary Problem');
            // $table->string('SBU Owner (Activation List Number) (Activation List)');
            // $table->string('Customer Group');
            // $table->string('Description (Customer Segment) (Segment)')->nullable()->default(NULL);
            // $table->string('Team Issue')->nullable()->default(NULL);
            // $table->integer('Total Amount (Activation List Number) (Activation List)');
            // $table->string('Status Reason');
            // $table->string('Status');
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
