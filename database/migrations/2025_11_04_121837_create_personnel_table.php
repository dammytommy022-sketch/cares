<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('personnel', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->enum('role', ['Manager', 'Team Leader', 'Staff'])->default('Staff');
            $table->foreignId('house_id')->constrained('houses')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->enum('hours_type', ['8', '12'])->default('12');
            $table->enum('preferred_shift', ['Morning', 'Evening'])->default('Morning');
            $table->boolean('can_do_ot')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personnel');
    }
};
