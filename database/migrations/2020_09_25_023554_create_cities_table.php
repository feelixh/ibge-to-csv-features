<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('idh')->nullable();
            $table->float('urban')->nullable();
            $table->string('name')->nullable();
            $table->float('rural')->nullable();
            $table->float('youngs')->nullable();
            $table->float('adults')->nullable();
            $table->float('isolated')->nullable();
            $table->float('catholic')->nullable();
            $table->float('spiritist')->nullable();
            $table->float('elderlies')->nullable();
            $table->float('evangelical')->nullable();
            $table->integer('population')->nullable();
            $table->integer('covid_deaths')->nullable();
            $table->float('without_religion')->nullable();
            $table->integer('covid_confirmed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
