<?php

namespace App\Http\Controllers;

use App\Materias;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Materias::get();
        // Seleccionar solo los nombres de las materias
        return Materias::get();
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
        $id = Materias::create($request->all())->id;
        return response()->json(['id' => $id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function show(Materias $materias)
    {
        return $materias;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function edit(Materias $materias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materias $materias)
    {
        $id = $request->id;
        $materia = Materias::find($id);
        $materia->update($request->all());
        return response()->json(['id' => $id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Materias $materias)
    {
        $materias->delete($id);
        return response()->json(['id' => $id], 200);
    }
}
