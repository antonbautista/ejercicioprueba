<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Grupo;

class EmpleadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){
        $grupo= Grupo::select()->get();
        return view('registrar',compact('grupo'));

        //return ["d"=>"test"];
    }

    public function store(Request $request){
       

        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellidopaterno' => 'required',
            'apellidomaterno' => 'required',
            'edad' => 'required',
            'puesto' => 'required',
            'grupo' => 'required'
        ]);

        $tbl = new Empleados;
        $tbl->nombre = $request->nombre;
        $tbl->apellidopaterno = $request->apellidopaterno;
        $tbl->apellidomaterno = $request->apellidomaterno;
        $tbl->edad = $request->edad;
        $tbl->puesto = $request->puesto;
        $tbl->id_grupo = $request->grupo;


        return $tbl->save(); 
       // if($tbl->save()){
       //     return redirect('/home');
       // }else{
       //     return redirect('/registrar');
       // }
    }//
    
}
