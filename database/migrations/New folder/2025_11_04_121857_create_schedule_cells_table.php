<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('schedule_cells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
            $table->foreignId('personnel_id')->constrained('personnel')->onDelete('cascade');
            $table->date('date');
            $table->string('day_name', 10);
            $table->enum('shift_type', ['8', '12', 'OT', 'AL', 'T08', 'T12', 'Off'])->nullable();
            $table->integer('hours')->default(0);
            $table->boolean('is_overtime')->default(false);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_cells');
    }
};
