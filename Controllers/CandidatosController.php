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

    function create(){
        return view('candidatos.create');
    }

    function store(Request $request){

        $data = $request->all();
        
        unset($data['_token']);

        if(!empty($data['nome']) && !empty($data['partido']) && !empty($data['numero']) && !empty($data['cargo']) && !empty($data['periodo'])){

            DB::insert("INSERT INTO candidatos(nome, partido, numero, cargo, periodo) VALUES (:nome, :partido, :numero, :cargo, :periodo);", $data);

        }

        //return redirect('/cursos');

    }

    function edit($id){
        
        $candidatos = DB::select("SELECT * FROM candidatos WHERE id = ?", [$id]);

        return view('candidatos.edit', ['candidato' => $candidatos[0]]);

    }

    function update(Request $request){
        
        $data = $request->all();
        
        unset($data['_token']);

        if(!empty($data['nome']) && !empty($data['partido']) && !empty($data['numero']) && !empty($data['cargo']) && !empty($data['periodo'])){

            DB::update("UPDATE candidatos SET nome = :nome, partido = :partido, numero = :numero, cargo = :cargo, periodo = :periodo WHERE id = :id", $data);
        
        }

        //return redirect('/cursos');
    }

    function destroy($id){
        DB::delete("DELETE FROM candidatos WHERE id = ?", [$id]);

        //return redirect('/cursos');
    }
}
