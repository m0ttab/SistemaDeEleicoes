<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Resultado extends Controller {

    public function index(){

        var_dump($candidatos);
        

        foreach($usuarios as $usuario) {
            echo $usuario->posts()->count();
       }
    }

}

?>
