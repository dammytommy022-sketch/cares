<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daily_care_records', function (Blueprint $table) {
            $table->id();

            // Relationships (VARCHAR based)
            $table->string('resident_id');     // patients.resident_id
            $table->string('employee_id')->nullable(); // staff.employee_id
            $table->string('staff_initials')->nullable();

            // Core fields
            $table->date('date');
            $table->string('task_type'); // Meals, Mobility, Personal Care, etc
            $table->boolean('completed')->default(true);
            $table->text('notes')->nullable();

            // Meta
            $table->timestamps();

            // Indexes (NO FK constraint because VARCHAR)
            $table->index('resident_id');
            $table->index('employee_id');
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_care_records');
    }
};
