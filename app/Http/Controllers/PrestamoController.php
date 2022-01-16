<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

/**
 * Class PrestamoController
 * @package App\Http\Controllers
 */
class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $multa = null;

        $prestamos = Prestamo::paginate();

        return view('prestamo.index', compact('prestamos', 'multa'))
            ->with('i', (request()->input('page', 1) - 1) * $prestamos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prestamo = new Prestamo();
        return view('prestamo.create', compact('prestamo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Prestamo::$rules);

        $prestamo = Prestamo::create($request->all());

        return redirect()->route('prestamos.index')
            ->with('success', 'Prestamo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);

        return view('prestamo.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestamo = Prestamo::find($id);

        return view('prestamo.edit', compact('prestamo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Prestamo $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        request()->validate(Prestamo::$rules);

        $prestamo->update($request->all());

        return redirect()->route('prestamos.index')
            ->with('success', 'Prestamo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id)->delete();

        return redirect()->route('prestamos.index')
            ->with('success', 'Prestamo deleted successfully');
    }

    public function filtrar(Request $request){ 

        $prestamos = Prestamo::all();

        $curdate = Carbon::now(); 

        foreach($prestamos as $prestamo){
            
            $fin = $prestamo->fecha_fin->toDateTimeString();
            $entrega = $prestamo->fecha_entrega->toDateTimeString();

            $estado = $prestamo->estado;

            if($estado == 'Devuelto'){
                if($entrega > $fin){
                    $imp = 5;
                    $dias_mora = $entrega->diffInDays($fin);
                    $multa = $dias_mora * $imp;
                }else{
                    $multa = 8;
                }
            }else{
                if($curdate > $fin){
                    $imp = 5;
                    $dias_mora = $curdate->diffInDays($fin);
                    $multa = $dias_mora * $imp;
                }else{
                    $multa = 7;
                }
                echo($fin);
            }
        }


        $prestamos = Prestamo::where('fecha_inicio', '>=', $request->fecha_inicio)
            ->where('fecha_fin', '<=', $request->fecha_fin)
            ->paginate();  

        return view('prestamo.index', compact('prestamos', 'multa'))
            ->with('i', (request()->input('page', 1) - 1) * $prestamos->perPage());

    }
}
