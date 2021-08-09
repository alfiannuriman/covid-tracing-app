<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckInCheckOutDateToPlaceRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('place_registrations', function (Blueprint $table) {
            $table->dropColumn('place_registration_type_id');

            $table->dateTime('check_in_date', 0)->nullable();
            $table->dateTime('check_out_date', 0)->nullable();
            $table->boolean('is_session_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('place_registrations', function (Blueprint $table) {
            $table->$table->foreignId('place_registration_type_id');

            $table->dropColumn(['check_in_date', 'check_out_date', 'is_session_active']);
        });
    }
}
