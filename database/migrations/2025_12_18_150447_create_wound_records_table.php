<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wound_records', function (Blueprint $table) {
            $table->id();

            $table->string('resident_id');
            $table->date('date');
            $table->string('wound_type');
            $table->string('location');
            $table->string('dressing')->nullable();
            $table->text('notes')->nullable();

            $table->string('staff_initials');
            $table->timestamps();

            $table->index('resident_id');
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wound_records');
    }
};
