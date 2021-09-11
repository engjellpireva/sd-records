<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrestWarrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrest_warrants', function (Blueprint $table) {
            $table->id();
            $table->string('publisher');
            $table->integer('publisher_id');
            $table->string('name');
            $table->string('alias');
            $table->integer('age');
            $table->string('gender');
            $table->string('race');
            $table->bigInteger('number');
            $table->string('description');
            $table->string('date');
            $table->string('narrative');
            $table->string('type');
            $table->integer('active');
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
        Schema::dropIfExists('arrest_warrants');
    }
}
