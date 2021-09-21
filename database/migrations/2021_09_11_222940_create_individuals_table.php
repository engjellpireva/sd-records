<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->string('publisher');
            $table->integer('publisher_id');
            $table->string('name');
            $table->string('image')->default('https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg');
            $table->string('alias')->default("N/A")->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->default("N/A")->nullable();
            $table->string('gender')->default("N/A");
            $table->string('race')->default("N/A");
            $table->biginteger('number')->nullable();
            $table->string('description')->default("N/A");
            $table->string('gang')->default("None");
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
        Schema::dropIfExists('individuals');
    }
}
