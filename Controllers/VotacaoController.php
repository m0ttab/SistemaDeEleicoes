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

        $periodos = DB::select('select * from periodos');

        $permissao = false;

        foreach($periodos as $periodo){
            
            $ini = strtotime($periodo->dt_inicio);
            $fim = strtotime($periodo->dt_fim);
            $agora = strtotime(date('Y-m-d'));
    
            if($agora >= $ini && $agora <= $fim){
                
                $permissao = true;
    
            }
  
        }
  
        return view('votacao.create', [
            'permissao' => $permissao
        ]);
    
    }

    function store(Request $request){

        $data = $request->all();
  
        unset($data['_token']);
  
        $periodos = DB::select('select * from periodos');
  
        $permissao = false;
  
        foreach($periodos as $periodo){
            
            $ini = strtotime($periodo->dt_inicio);
      
            $fim = strtotime($periodo->dt_fim);
      
            $agora = date('Y-m-d H:i:s');
      
            if(strtotime($agora) >= $ini && strtotime($agora) <= $fim){
                
                $permissao = true;
                $periodo_id = $periodo->id;

            }
  
        }
  
        if($permissao){
            
            $eleitor_titulo = $data['titulo'];
    
            $eleitor = DB::select('select * from eleitores where titulo = :titulo', [':titulo' => $eleitor_titulo]);

            if(!empty($eleitor)){

                // verifica se o eleitor ja votou nesse periodo
            $votantes = DB::select('SELECT * FROM votantes WHERE periodo = :periodo_id AND eleitor = :eleitor_id;', [':periodo_id' => $periodo_id, ':eleitor_id' => $eleitor[0]->id]);

            if(empty($votantes)){
                
                if(!isset($data['candidato'])){
                    
                    $data['candidato'] = 'Nulo';
                    $candidato_nome = 'Nulo';
      
                }else{
                    
                    // verifica se o número do candidato informado realmente existe e, se n existir, coloca nulo
                    $candidatos = DB::select('SELECT * FROM candidatos WHERE numero = :candidato;', [':candidato' => $data['candidato']]);
        
                    if(empty($candidatos)){
                        
                        $data['candidato'] = 'Nulo';
                        $candidato_nome = 'Nulo';
        
                    }else{
                        
                        $candidato_nome = $candidatos[0]->nome;

                    }
      
                }
      
                // zona e secao devem vir da consulta dos dados do eleitor
                if(!empty($agora) && !empty($data['candidato']) && !empty($eleitor[0]->zona) && !empty($eleitor[0]->secao) && !empty($data['titulo'])){
                    
                    DB::insert("INSERT INTO votos(data_hora, candidato, zona, secao) VALUES(:data_hora, :candidato, :zona, :secao);", [':data_hora' => $agora, ':candidato' => $data['candidato'], ':zona' => $eleitor[0]->zona, ':secao' => $eleitor[0]->secao]);
        
                    DB::insert("INSERT INTO votantes(eleitor, periodo) VALUES(:eleitor, :periodo);", [':eleitor' => $eleitor[0]->id, ':periodo' => $periodo_id]);

                    // talvez seja necessário escrever em quem o eleitor votou, então pode ser necessário desativar a função assíncrona do formulário para que seja exibido o comprovante de votacao

                    var_dump($candidato_nome);

                    //return view('votacao.comprovante', ['candidato' => $candidato_nome]);
      
                }
    
            }

            }
  
        }

        //return redirect('/periodos');

    }

}
