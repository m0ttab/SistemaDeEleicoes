<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('votantes', function (Blueprint $table) {
            $table->increments("id");

            $table->string("eleitor", 100);
            $table->string("periodo", 100);
            $table->foreign('periodo')->references('id')->on('periodos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        
    }
};
