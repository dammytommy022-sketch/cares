<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('behaviour_incidents', function (Blueprint $table) {
            $table->id();

            $table->string('resident_id');
            $table->date('date');
            $table->string('incident_type');
            $table->text('description')->nullable();
            $table->text('action_taken')->nullable();

            $table->string('staff_initials');
            $table->timestamps();

            $table->index('resident_id');
            $table->index('incident_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('behaviour_incidents');
    }
};
