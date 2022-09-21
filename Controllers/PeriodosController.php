<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodosController extends Controller
{
    function index(){
        $periodos = DB::select('select * from periodos;');

        return view('periodos.index', [
            'periodos' => $periodos
        ]);
    }

    public function verificar_periodo($data, $id = null){
  
        $periodos = DB::select('select * from periodos');
          
        $permissao = true;
          
        foreach($periodos as $periodo){

            if($periodo->id != $id){

                $ini = date('Y-m-d', strtotime($periodo->dt_inicio));
              
                $fim = date('Y-m-d', strtotime($periodo->dt_fim));
                
                if($data['dt_inicio'] < $data['dt_fim']){
                
                    if($data['dt_inicio'] >= $ini && $data['dt_fim'] <= $fim){
                        
                        $permissao = false;
                    
                    }else if($ini >= $data['dt_inicio'] && $fim <= $data['dt_fim']){
                        
                        $permissao = false;
                    
                    }else if($data['dt_inicio'] <= $ini && $data['dt_fim'] <= $fim && $data['dt_fim'] >= $ini){
                        
                        $permissao = false;
                    
                    }else if($data['dt_inicio'] >= $ini && $data['dt_inicio'] <= $fim && $data['dt_fim'] >= $fim){
                        
                        $permissao = false;
                    
                    }
                
                }else{
                    
                    $permissao = false;

                }

            }
            
        }
          
        return $permissao;
        
    }      

    function create(){
        return view('periodos.create');
    }

    function store(Request $request){

        $data = $request->all();
    
        unset($data['_token']);

        $permissao = $this->verificar_periodo($data);
    
        if($permissao){
            
            if(isset($data['nome']) && isset($data['dt_inicio']) && isset($data['dt_fim'])){
                
                DB::insert("INSERT INTO periodos(nome, dt_inicio, dt_fim) VALUES (:nome, :dt_inicio, :dt_fim);", [':nome' => $data['nome'], ':dt_inicio' => $data['dt_inicio'], ':dt_fim' => $data['dt_fim']]);
        
                echo json_encode([
                    'mensagem' => 'Período cadastrado com sucesso!'
                ]);
        
            }else{
        
                echo json_encode([
                    'mensagem' => 'Preencha todos os campos!'
                ]);
        
            }
      
        }else{
            
            echo json_encode([
                'mensagem' => 'Erro! Talvez o período com estas datas já exista!'
            ]);

        }
        
        //return redirect('/periodos');
    }

    function edit($id){
        $periodos = DB::select("SELECT * FROM periodos WHERE id = :id", [':id' => $id]);

        return view('periodos.edit', ['periodo' => $periodos[0]]);
    }

    function update(Request $request){
        
        $data = $request->all();

        unset($data['_token']);

        $permissao = $this->verificar_periodo($data, $data['id']);

        if($permissao){

            if(!empty($data['nome']) && !empty($data['dt_inicio']) && !empty($data['dt_fim'])){ 
                
                DB::update("UPDATE periodos SET nome = :nome, dt_inicio = :dt_inicio, dt_fim = :dt_fim WHERE id = :id", $data);

                echo json_encode([
                    'mensagem' => 'Período atualizado com sucesso!'
                ]);

            }else{
        
                echo json_encode([
                    'mensagem' => 'Preencha todos os campos!'
                ]);
        
            }

        }else{
            
            echo json_encode([
                'mensagem' => 'Erro! Talvez o período com estas datas já exista!'
            ]);

        }
        
        //return redirect('/periodos');
    }

    function destroy($id){

        DB::delete("DELETE FROM periodos WHERE id = :id", [':id' => $id]);

        //return redirect('/periodos');
    }
}
