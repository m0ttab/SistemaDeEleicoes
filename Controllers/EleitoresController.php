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

    function create(){
        return view('eleitores.create');
    }

    function store(Request $request){
        $data = $request->all();

        unset($data['_token']);

        if(!empty($data['nome']) && !empty($data['titulo']) && !empty($data['zona']) && !empty($data['secao'])){

            DB::insert("INSERT INTO eleitores(nome, titulo, zona, secao) VALUES (:nome, :titulo, :zona, :secao)", $data);

        }

        //return redirect('/turmas');

    }

    function edit($id){
        $turmas = DB::select("SELECT * FROM eleitores WHERE id = ?", [$id]);

        return view('eleitores.edit', ['eleitores' => $eleitores[0]]);
    }

    function update(Request $request){
        
        $data = $request->all();
        
        unset($data['_token']);

        if(!empty($data['nome']) && !empty($data['tituo']) && !empty($data['zona']) && !empty($data['secao'])){

            DB::update("UPDATE eleitores SET nome = :nome, titulo = :titulo, zona = :zona, secao = :secao WHERE id = :id", $data);

        }

        //return redirect('/turmas');
    }

    function destroy($id){
        DB::delete("DELETE FROM eleitores WHERE id = ?", [$id]);

        //return redirect('/turmas');
    }
}
