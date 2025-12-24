<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // SECTION 1 — Basic Personal Information
            $table->json('basic_info')->nullable();

            // SECTION 2 — Parent / Guardian / Legal Authority
            $table->json('guardian_info')->nullable();

            // SECTION 3 — Placement Information
            $table->json('placement_info')->nullable();

            // SECTION 4 — Medical & Health Information
            $table->json('medical_info')->nullable();

            // SECTION 5 — Education Information
            $table->json('education_info')->nullable();

            // SECTION 6 — Behavioural & Risk Information
            $table->json('behaviour_info')->nullable();

            // SECTION 7 — Social & Family Information
            $table->json('social_family_info')->nullable();

            // SECTION 8 — Legal & Safeguarding Information
            $table->json('legal_safeguarding_info')->nullable();

            // SECTION 9 — Daily Living Needs
            $table->json('daily_living_info')->nullable();

            // SECTION 10 — Documents (file paths)
            $table->json('documents')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
