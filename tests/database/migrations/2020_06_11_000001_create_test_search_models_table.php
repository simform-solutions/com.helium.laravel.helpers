<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestSearchModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_search_models', function (Blueprint
        $table) {
	        $table->id('id');
	        $table->timestamps();
	        $table->integer('age');
	        $table->unsignedBigInteger('parent_id')->nullable();

	        $table->foreign('parent_id')
                ->references('id')
                ->on('test_search_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_search_models');
    }
}
