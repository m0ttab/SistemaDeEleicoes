<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('eleitores', function (Blueprint $table) {
            $table->increments("id");

            $table->string("nome", 100);
            $table->string("titulo", 12);
            $table->string("zona", 100);
            $table->string("secao", 100);
            $table->unique('titulo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleitores');
    }
};
