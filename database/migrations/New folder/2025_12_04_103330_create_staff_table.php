<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();

            // Minimal searchable info
            $table->string('full_name');
            $table->string('employee_id')->unique();
            $table->string('role'); // Manager, Team Leader, Support Worker

            // JSON columns for each section
            $table->json('basic_info')->nullable();
            $table->json('employment_details')->nullable();
            $table->json('qualifications_training')->nullable();
            $table->json('compliance_legal')->nullable();
            $table->json('performance_notes')->nullable();
            $table->json('emergency_contact')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
