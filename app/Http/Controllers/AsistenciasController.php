<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistencias;


class AsistenciasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index(Request $request){
         
        try {
            foreach($request->lista as $v){
                //print_r($v['asistencia']);
                $tbl = new Asistencias;
                $tbl->id_empleados=intval($v['id']);
                $tbl->asistencia=intval($v['asistencia']);
                $tbl->save();
             }

             return ["status"=>true,"messages"=>"Registro exitoso."];
        } catch (\Throwable $th) {
            return ["status"=>false,"messages"=>"Falló el registro."];
        }

        

    }
}
