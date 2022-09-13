<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotacaoController extends Controller
{
    function index(){
        /*
        $periodos = DB::select('select * from periodos;');

        return view('periodos.index', [
            'periodos' => $periodos
        ]);
        */
    }

    function create(){
        return view('votacao.create');
    }

    function store(Request $request){

        $request = $request->all();
        unset($request['_token']);

        $dt_hoje = date('Y-m-d');
        $periodo = DB::select('SELECT * FROM periodos WHERE dt_inicio >= :dt_hoje AND dt_fim <= :dt_hoje;', ['dt_hoje' => $dt_hoje]);

        if($periodo->rowCount() == 1){

            $periodo_id = $periodo[0]['id'];
            $eleitor_id = $request['eleitor'];

            $votantes = DB::select('SELECT * FROM votantes WHERE periodo = :periodo_id AND eleitor = :eleitor_id;', [':periodo_id' => $periodo_id, ':eleitor_id' => $eleitor_id]);

            if($votantes->rowCount() == 0){

                if(!isset($request['candidato'])){

                    $request['candidato'] = 'Nulo';

                }else{

                    $candidatos = DB::select('SELECT * FROM candidatos WHERE numero = :candidato;', [':candidato' => $request['candidato']]);

                    if($candidatos->rowCount() == 0){

                        $request['candidato'] = 'Nulo';

                    }

                }

                if(!empty($request['data_hora']) && !empty($request['candidato']) && !empty($request['zona']) && !empty($request['secao']) && !empty($request['eleitor'])){

                    DB::insert("INSERT INTO votos(data_hora, candidato, zona, secao) VALUES (:data_hora, :candidato, :zona, :secao);", [':data_hora' => $request['data_hora'], ':data_hora' => $request['data_hora'], ':data_hora' => $request['data_hora'], ':data_hora' => $request['data_hora']]);
                    
                    DB::insert("INSERT INTO votantes(eleitor, periodo) VALUES (:eleitor, :periodo);", [':eleitor' => $request['eleitor'], ':periodo' => $periodo_id]);

                }

            }

        }

        //return redirect('/periodos');
    }

}
