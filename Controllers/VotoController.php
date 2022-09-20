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
          
          $candidatos_nomes = [
            
            'presidente' => $data['presidente'],
            'governador' => $data['governador'],
            'senador' => $data['senador'],
            'deputado_estadual' => $data['deputado_estadual'],
            'deputado_federal' => $data['deputado_federal']
            
          ];
          
          foreach($candidatos_nomes as $cargo => $numero){
            
            if(!isset($numero)){
              
              $candidatos_nomes[$cargo] = 'Nulo';
              
            }else{
              
              $candidatos = DB::select('SELECT * FROM candidatos WHERE numero = :numero AND cargo = :cargo;', [':numero' => $numero, ':cargo' => $cargo);
              
              if(empty($candidatos)){
                
                $candidatos_nomes[$cargo] = 'Nulo';
                //$candidato_nome = 'Nulo';
              
                
              }else{
                
                $candidatos_nomes[$cargo] = $candidatos[0]->nome;
                
              }
              
            }
            
          }
          
          if(!empty($agora) && !empty($eleitor[0]->zona) && !empty($eleitor[0]->secao) && !empty($data['titulo'])){
            
            foreach($candidatos_nomes as $cargo => $numero){
              
              DB::insert("INSERT INTO votos(data_hora, candidato, zona, secao) VALUES(:data_hora, :candidato, :zona, :secao);", [':data_hora' => $agora, ':candidato' => $data[$cargo], ':zona' => $eleitor[0]->zona, ':secao' => $eleitor[0]->secao]);
              
            }
            
            DB::insert("INSERT INTO votantes(eleitor, periodo) VALUES(:eleitor, :periodo);", [':eleitor' => $eleitor[0]->id, ':periodo' => $periodo_id]);
            
            return view('votacao.comprovante', ['candidatos' => $candidatos_nomes]);
            
          }else{
            
            return view('votacao.comprovante', ['mensagem' => 'Preencha todos os campos!']);
            
          }
          
        }else{
          
          return view('votacao.comprovante', ['mensagem' => 'Você já votou neste período!']);
          
        }
        
      }else{
        
        return view('votacao.comprovante', ['mensagem' => 'Verifique se o seu título está correto e tente novamente!']);
        
      }
      
    }else{
      
      return view('votacao.comprovante', ['mensagem' => 'Você está fora do período de votação!']);
      
    }
    
    //return redirect('/periodos');
  
  }

}

?>