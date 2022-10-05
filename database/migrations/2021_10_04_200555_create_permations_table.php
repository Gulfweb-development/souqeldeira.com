<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // NAME OF PERMATIONS
            $table->string('label_en')->nullable();
            $table->string('label_ar')->nullable();
            $table->unsignedInteger('permation_for_id')->nullable();
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
        Schema::dropIfExists('permations');
    }
}
