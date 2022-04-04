<?php

namespace App\Http\Controllers;

use App\Inscripciones;
use Illuminate\Http\Request;

class InscripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inscripciones::selectRaw('GROUP_CONCAT(m.nombre) AS materias, GROUP_CONCAT(i.idMateria) AS idMateria, a.nombre AS alumnos, i.idAlumno')
            ->from('inscripciones AS i')
            ->join('materias AS m', 'm.idMateria', '=', 'i.idMateria')
            ->join('alumnos AS a', 'a.idAlumno', '=', 'i.idAlumno')
            ->groupBy('i.idAlumno')
            ->groupBy('a.nombre')
            ->orderBy('a.nombre')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Inscripciones::create($request->all())->idAlumno;
        return response()->json(['id' => $request->all()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscripciones  $inscripciones
     * @return \Illuminate\Http\Response
     */
    public function show(Inscripciones $inscripciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inscripciones  $inscripciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscripciones $inscripciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscripciones  $inscripciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripciones $inscripciones)
    {
        $id = $request->idAlumno;
        $inscripcion = Inscripciones::find($id);
        $inscripcion->update($request->all());
        return response()->json(['id' => $id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inscripciones  $inscripciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Inscripciones $inscripciones)
    {
        $id = $request->idAlumno;
    }
}
