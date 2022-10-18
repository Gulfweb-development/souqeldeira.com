<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('governorate_id')->constrained()->onDelete('cascade');
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('building_type_id')->constrained()->onDelete('cascade');
            $table->string('type')->comment('SALE  |  RENT | EXCHANGE');
            $table->string('title')->nullable(); // COMPINE TITLE FROM TYPE - GOVERNATE - REGIONS - Building Type NO title inputs
            $table->longText('text')->nullable();
            $table->string('price')->nullable();
            $table->bigInteger('views')->default(0)->nullable();
            $table->string('phone')->nullable();
            $table->string('code')->nullable()->comment('AUTO GENERATE');
            $table->timestamp('archived_at')->nullable()->comment('Hide it after 30 days');
            $table->boolean('is_featured')->default(0); // will remove them
            $table->boolean('is_approved')->default(1); // will remove them
            $table->softDeletes();
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
        Schema::dropIfExists('ads');
    }
}
