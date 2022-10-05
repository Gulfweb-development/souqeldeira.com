<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return 7ALET 3KAAR ( METSHTEP | NO)
     */
    public function up()
    {
        Schema::create('building_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->unsignedBigInteger('admin_id')->nullable();
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
        Schema::dropIfExists('building_statuses');
    }
}
