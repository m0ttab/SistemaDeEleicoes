<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->increments("id");

            $table->string("nome", 100);
            $table->string("partido", 12);
            $table->string("numero", 20);
            $table->string("cargo", 155);
            $table->string("periodo", 155);
            $table->unique('numero');
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
};
