<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAreasTable extends Migration
{
    
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('progress')->default(0);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('areas');
    }
} 