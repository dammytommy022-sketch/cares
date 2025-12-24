<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->string('resident_id', 50);
            $table->string('employee_id', 50);

            $table->date('date');
            $table->string('activity');
            $table->string('participation_level')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('resident_id')
                ->references('resident_id')
                ->on('patients')
                ->cascadeOnDelete();

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('staff')
                ->cascadeOnDelete();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
