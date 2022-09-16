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

    function create(){
        return view('periodos.create');
    }

    function store(Request $request){

        $data = $request->all();

        unset($data['_token']);

        if(!empty($data['dt_inicio']) && !empty($data['dt_fim']) && !empty($data['nome'])){
            
            // $hora = date('H:i:s');

            // $data['dt_inicio'] = $data['dt_inicio'].' '.$hora;

            // $data['dt_fim'] = $data['dt_fim'].' '.$hora;

            $data['dt_inicio'] = date('Y-m-d H:i:s', strtotime($data['dt_inicio']));

            $data['dt_fim'] = date('Y-m-d H:i:s', strtotime($data['dt_fim']));

            DB::insert("INSERT INTO periodos(nome, dt_inicio, dt_fim) VALUES (:nome, :dt_inicio, :dt_fim);", $data);

        }

        //return redirect('/periodos');
    }

    function edit($id){
        $periodos = DB::select("SELECT * FROM periodos WHERE id = ?", [$id]);

        return view('periodos.edit', ['periodo' => $periodos[0]]);
    }

    function update(Request $request){
        
        $data = $request->all();
        
        unset($data['_token']);

        if(!empty($data['nome']) && !empty($data['dt_inicio']) && !empty($data['dt_fim'])){

            DB::update("UPDATE periodos SET nome = :nome, dt_inicio = :dt_inicio, dt_fim = :dt_fim WHERE id = :id", $data);

        }
        
        //return redirect('/periodos');
    }

    function destroy($id){
        DB::delete("DELETE FROM periodos WHERE id = ?", [$id]);

        //return redirect('/periodos');
    }
}
