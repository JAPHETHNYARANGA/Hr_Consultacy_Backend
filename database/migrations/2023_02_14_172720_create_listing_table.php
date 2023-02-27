<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing', function (Blueprint $table) {
            $table->id();
            $table->string('position')->nullable();
            $table->string('Requirements')->nullable();
            $table->string('benefits')->nullable();
            $table->string('tasks')->nullable();
            $table->string('company')->nullable();
            $table->date('applicationDate')->nullable();
            $table->integer('salary')->nullable();            
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
        Schema::dropIfExists('listing');
    }
};