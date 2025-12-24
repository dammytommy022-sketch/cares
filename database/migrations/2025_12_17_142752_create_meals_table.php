<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();

            $table->string('resident_id', 50);
            $table->string('employee_id', 50);

            $table->date('date');
            $table->string('meal');
            $table->string('portion');
            $table->integer('fluids')->nullable();
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
        Schema::dropIfExists('meals');
    }
}
