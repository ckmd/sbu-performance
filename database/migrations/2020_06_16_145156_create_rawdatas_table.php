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
            $table->bigInteger('Service ID');
            $table->text('Customer');
            $table->text('Region SBU (Terminating) (Address)');
            $table->dateTime('Created On', 0);
            $table->dateTime('Close Date', 0);
            $table->dateTime('Interference Time', 0);
            $table->text('Service ID Status');
            $table->text('Product');
            $table->text('Interference Cause (Incident ID) (Incident)')->nullable()->default(NULL);
            $table->text('Address (Terminating) (Address)');
            $table->text('Province (Terminating) (Address)');
            $table->text('State (Terminating) (Address)');
            $table->text('Bandwidth');
            $table->text('Address');
            $table->integer('Stop Clock Duration');
            $table->text('Ticket Type');
            $table->text('Interference (Incident ID) (Incident)')->nullable()->default(NULL);
            $table->integer('Interference Net Duration (DurationId) (Duration)');
            $table->text('Interference Location (Incident ID) (Incident)')->nullable()->default(NULL);
            $table->text('Summary Problem');
            $table->text('SBU Owner (Activation List Number) (Activation List)');
            $table->text('Customer Group');
            $table->text('Description (Customer Segment) (Segment)')->nullable()->default(NULL);
            $table->text('Team Issue')->nullable()->default(NULL);
            $table->integer('Total Amount (Activation List Number) (Activation List)');
            $table->text('Status Reason');
            $table->text('Status');
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
