<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatosController extends Controller
{
    function index(){
        $candidatos = DB::select('select * from candidatos;');

        return view('candidatos.index', [
            'candidatos' => $candidatos
        ]);
    }

    function verificar_candidato($data, $id = null){

        $candidatos = DB::select('select * from candidatos');
          
        $permissao = true;
          
        foreach($candidatos as $candidato){

            if($candidato->id != $id){
                
                if($data['numero'] == $candidato->numero){
                    
                    $permissao = false;

                }

            }
            
        }
          
        return $permissao;

    }

    function create(){
        return view('candidatos.create');
    }

    function store(Request $request){

        $data = $request->all();
        
        unset($data['_token']);

        $permissao = $this->verificar_candidato($data);

        if($permissao){

            if(!empty($data['nome']) && !empty($data['partido']) && !empty($data['numero']) && !empty($data['cargo']) && !empty($data['periodo'])){

                DB::insert("INSERT INTO candidatos(nome, partido, numero, cargo, periodo) VALUES (:nome, :partido, :numero, :cargo, :periodo);", $data);

                echo json_encode([
                    'mensagem' => 'Candidato cadastrado com sucesso!'
                ]);
        
            }else{
        
                echo json_encode([
                    'mensagem' => 'Preencha todos os campos!'
                ]);
        
            }
      
        }else{
            
            echo json_encode([
                'mensagem' => 'Erro! Talvez o candidato com este número já exista!'
            ]);

        }

        //return redirect('/cursos');

    }

    function edit($id){
        
        $candidatos = DB::select("SELECT * FROM candidatos WHERE id = :id", [':id' => $id]);

        return view('candidatos.edit', ['candidato' => $candidatos[0]]);

    }

    function update(Request $request){
        
        $data = $request->all();
        
        unset($data['_token']);

        $permissao = $this->verificar_candidato($data, $data['id']);

        if($permissao){

            if(!empty($data['nome']) && !empty($data['partido']) && !empty($data['numero']) && !empty($data['cargo']) && !empty($data['periodo'])){

                DB::update("UPDATE candidatos SET nome = :nome, partido = :partido, numero = :numero, cargo = :cargo, periodo = :periodo WHERE id = :id", $data);

                echo json_encode([
                    'mensagem' => 'Candidato atualizado com sucesso!'
                ]);
        
            }else{
        
                echo json_encode([
                    'mensagem' => 'Preencha todos os campos!'
                ]);
        
            }
      
        }else{
            
            echo json_encode([
                'mensagem' => 'Erro! Talvez o candidato com este número já exista!'
            ]);

        }

        //return redirect('/cursos');
    }

    function destroy($id){
        DB::delete("DELETE FROM candidatos WHERE id = :id", [':id' => $id]);

        //return redirect('/cursos');
    }
}
