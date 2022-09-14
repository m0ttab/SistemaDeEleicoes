<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Resultado extends Controller {

    public function index(){
        $eleitores = DB::select('select * from votos');

        return view('votos.index', [
            'votos' => $votos
        ]);
    }

}

?>