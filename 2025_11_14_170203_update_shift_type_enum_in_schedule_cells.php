<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShiftTypeEnumInScheduleCells extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_cells', function (Blueprint $table) {
            $table->enum('shift_type', ['8', '12', 'OT', 'AL', 'T08', 'T12', 'Off'])
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_cells', function (Blueprint $table) {
            $table->enum('shift_type', ['Morning', 'Evening', 'Off', 'AL', 'OT'])
                ->nullable()
                ->change();
        });
    }
}
