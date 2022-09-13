<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->increments("id");
            
            $table->dateTime("data_hora", 255);
            $table->string("cadidato", 255);
            $table->string("zona",100);
            $table->string("secao", 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
};
