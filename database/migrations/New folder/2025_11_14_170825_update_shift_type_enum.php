<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShiftTypeEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE schedule_cells MODIFY COLUMN shift_type 
            ENUM('8','12','OT','AL','T08','T12','Off') NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE schedule_cells MODIFY COLUMN shift_type 
            ENUM('Morning','Evening','Off','AL','OT') NULL");
    }
}
