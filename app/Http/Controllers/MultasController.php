<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MultasController extends Controller
{
    //
    public function index()
    {
        $multa = null; 

        $datos['prestamos'] = Prestamo::paginate(10);
        $datos['multa'] = $multa;
        return view('multas.index', $datos); 
    }

    public function filtrar(Request $request){ 
        $prestamos = Prestamo::where('fecha_inicio', '>=', $request->fecha_inicio)
            ->where('fecha_fin', '<=', $request->fecha_fin)
            ->get();  

        foreach ($prestamos as $prestamo) {
            $prestamo->multa = $this->calcularMulta($prestamo);
            //echo($prestamo->multa."<br>");
        }

        //echo($multa);
        $datos['prestamos'] = $prestamos;
        //echo($datos['prestamos']);
        return view('multas.index', $datos);
    }

    public function calcularMulta($prestamos){
        $multa = 0;
        $imp = 5;
        
            $estado = $prestamos->estado;

            $fecha_fin = Carbon::parse($prestamos->fecha_fin);
            $fecha_entrega = Carbon::parse($prestamos->fecha_entrega);
            $fecha_actual = Carbon::now();

            if($estado == 'Prestado'){
                if($fecha_actual > $fecha_fin){
                    $diferencia = $fecha_actual->diffInDays($fecha_fin);
                    $multa = $multa + ($diferencia * $imp);
                    //echo("primer if");
                }else{
                    $multa = $multa + 0;
                    //echo("segundo if");
                }
            }else{
                if($fecha_entrega > $fecha_fin){
                    $diferencia = $fecha_entrega->diffInDays($fecha_fin);
                    $multa = $multa + ($diferencia * $imp);
                    //echo("tercer if");
                }else{
                    $multa = $multa + 0;
                    //echo("cuarto if");
                }
            
        }
        return $multa;
    }

}
