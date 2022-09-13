<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->increments("id");

            $table->string("nome", 100);
            $table->string("dt_inicio", 20);
            $table->string("dt_fim", 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periodos');
    }
};
