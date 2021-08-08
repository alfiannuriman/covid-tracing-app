<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerting_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alerting_id');
            $table->foreignId('place_registration_subject_id')->comment('Place registration subject when user related');
            $table->foreignId('place_registration_object_id')->comment('Place registration object when user related');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerting_details');
    }
}
