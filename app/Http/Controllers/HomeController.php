<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistencias;
use App\Empleados;
use App\Grupo;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($fecha=null)
    {
        $fechab=$fecha !=null ?$fecha: date('Y-m-d');


        $empleados= Empleados::join('grupo', 'grupo.id', '=', 'empleados.id_grupo')
                            ->leftjoin('asistencias', 'asistencias.id_empleados', '=', 'empleados.id')
                            ->select(
                                'empleados.id',
                                'empleados.nombre',
                                'empleados.apellidopaterno',
                                'empleados.apellidomaterno',
                                'empleados.edad',
                                'empleados.puesto',
                                'grupo.nombregrupo',
                                'asistencias.asistencia',
                                'asistencias.created_at'
                            )
                            ->orWhereDate('asistencias.created_at',$fechab)
                            ->orWhere('asistencias.created_at',null)
                            ->get();



        if(count($empleados)==0){
            $empleados= Empleados::join('grupo', 'grupo.id', '=', 'empleados.id_grupo')
                            ->leftjoin('asistencias', 'asistencias.id_empleados', '=', 'empleados.id')
                            ->select(
                                'empleados.id',
                                'empleados.nombre',
                                'empleados.apellidopaterno',
                                'empleados.apellidomaterno',
                                'empleados.edad',
                                'empleados.puesto',
                                'grupo.nombregrupo',
                                'asistencias.asistencia',
                                'asistencias.created_at'
                            )
                            ->addSelect(DB::raw("asistencias.asistencia, (CASE WHEN (asistencias.asistencia = 0) THEN '1' ELSE '0' END) as asistencia"))
                            ->get();
        }
        
        //return $empleados;
        return view('home',compact('empleados'),compact('grupo'));
    }
}
