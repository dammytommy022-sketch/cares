<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('restraint_records', function (Blueprint $table) {
            $table->id();

            $table->string('resident_id');
            $table->string('employee_id')->nullable();

            $table->dateTime('incident_datetime');

            $table->enum('record_type', [
                'Challenging Behaviour',
                'Physical Restraint',
                'Environmental Intervention'
            ]);

            $table->string('trigger')->nullable();
            $table->string('restraint_method')->nullable();

            $table->enum('severity', ['Low', 'Medium', 'High'])
                  ->default('Low');

            $table->integer('duration_minutes')->nullable();

            $table->text('intervention_details')->nullable();
            $table->text('outcome')->nullable();

            $table->boolean('injury_occurred')->default(false);
            $table->boolean('reported')->default(false);

            $table->timestamps();

            $table->index('resident_id');
            $table->index('incident_datetime');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restraint_records');
    }
};
