<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EleitoresController extends Controller
{
    function index(){
        $eleitores = DB::select('select * from eleitores');

        return view('eleitores.index', [
            'eleitores' => $eleitores
        ]);
    }

    function verificar_eleitor($data, $id = null){

        $eleitores = DB::select('select * from eleitores');
          
        $permissao = true;
          
        foreach($eleitores as $eleitor){

            if($eleitor->id != $id){
                
                if($data['titulo'] == $eleitor->titulo){
                    
                    $permissao = false;

                }

            }
            
        }
          
        return $permissao;

    }

    function create(){
        return view('eleitores.create');
    }

    function store(Request $request){
        $data = $request->all();

        unset($data['_token']);

        $permissao = $this->verificar_eleitor($data);

        if($permissao){

            if(!empty($data['nome']) && !empty($data['titulo']) && !empty($data['zona']) && !empty($data['secao'])){

                DB::insert("INSERT INTO eleitores(nome, titulo, zona, secao) VALUES (:nome, :titulo, :zona, :secao)", $data);

                echo json_encode([
                    'mensagem' => 'Eleitor cadastrado com sucesso!'
                ]);
        
            }else{
        
                echo json_encode([
                    'mensagem' => 'Preencha todos os campos!'
                ]);
        
            }
      
        }else{
            
            echo json_encode([
                'mensagem' => 'Erro! Talvez o eleitor com este título já exista!'
            ]);

        }

        //return redirect('/turmas');

    }

    function edit($id){
        $eleitores = DB::select("SELECT * FROM eleitores WHERE id = :id", [':id' => $id]);

        return view('eleitores.edit', ['eleitor' => $eleitores[0]]);
    }

    function update(Request $request){
        
        $data = $request->all();
        
        unset($data['_token']);

        $permissao = $this->verificar_eleitor($data, $data['id']);
        
        if($permissao){

            if(!empty($data['nome']) && !empty($data['titulo']) && !empty($data['zona']) && !empty($data['secao'])){

                DB::update("UPDATE eleitores SET nome = :nome, titulo = :titulo, zona = :zona, secao = :secao WHERE id = :id", $data);

                echo json_encode([
                    'mensagem' => 'Eleitor atualizado com sucesso!'
                ]);
        
            }else{
        
                echo json_encode([
                    'mensagem' => 'Preencha todos os campos!'
                ]);
        
            }
      
        }else{
            
            echo json_encode([
                'mensagem' => 'Erro! Talvez o eleitor com este título já exista!'
            ]);

        }

        //return redirect('/turmas');
    }

    function destroy($id){
        DB::delete("DELETE FROM eleitores WHERE id = :id", [':id' => $id]);

        //return redirect('/turmas');
    }
}
