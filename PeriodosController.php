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

        if(!empty($data['ano']) && !empty($data['dt_inicio']) && !empty($data['dt_fim']) && !empty($data['hora']) && !empty($data['hr_inicio']) && !empty($data['hr_fim'])){

            DB::insert("INSERT INTO periodos(ano, dt_inicio, dt_fim, hora, hr_inicio, hr_fim) VALUES (:ano, :dt_inicio, :dt_fim, :hora, :hr_inicio, :hr_fim);", $data);

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

        if(!empty($data['ano']) && !empty($data['dt_inicio']) && !empty($data['dt_fim'] && !empty($data['hora']) && !empty($data['hr_inicio']) && !empty($data['hr_fim']))){

            DB::update("UPDATE periodos SET ano = :ano, dt_inicio = :dt_inicio, dt_fim = :dt_fim, hora = :hora, hr_inicio = :hr_inicio, dt_fim = :dt_fim WHERE id = :id", $data);

        }
        
        //return redirect('/periodos');
    }

    function destroy($id){
        DB::delete("DELETE FROM periodos WHERE id = ?", [$id]);

        //return redirect('/periodos');
    }
}