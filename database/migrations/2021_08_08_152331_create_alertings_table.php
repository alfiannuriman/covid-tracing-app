<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('case_number')->comment('Case number for user referred to');
            $table->boolean('is_have_symptoms')->default(0);
            $table->date('symptoms_appear_date')->comment('Date when symptoms appear or user got tested');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('alertings');
    }
}
