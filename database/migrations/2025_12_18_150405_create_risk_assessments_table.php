<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id();

            $table->string('resident_id'); // VARCHAR
            $table->string('risk_type');
            $table->enum('risk_level', ['Low', 'Medium', 'High']);
            $table->text('description')->nullable();
            $table->text('controls')->nullable();

            $table->string('staff_initials')->nullable();
            $table->timestamps();

            $table->index('resident_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risk_assessments');
    }
};
