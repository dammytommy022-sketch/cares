<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();

            // IDs are VARCHAR in your system
            $table->string('resident_id');
            $table->string('employee_id')->nullable();

            $table->date('incident_date');
            $table->string('incident_type'); // Fall, Injury, Abuse, Medication Error, etc
            $table->string('location')->nullable();

            $table->text('description')->nullable();
            $table->text('action_taken')->nullable();

            $table->enum('status', ['Open', 'Monitoring', 'Closed'])
                  ->default('Open');

            $table->boolean('reported_to_manager')->default(false);
            $table->boolean('safeguarding_required')->default(false);

            $table->timestamps();

            // Optional indexes
            $table->index('resident_id');
            $table->index('incident_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
