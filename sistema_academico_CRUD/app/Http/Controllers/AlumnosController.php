<?php

namespace App\Http\Controllers;

use App\Alumnos;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return alumnos::get();
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
    public function store(Request $request) // CREATE
    {
        $id = alumnos::create($request->all())->id;
        return response()->json(['id' => $id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumnos  $modelAlumnos
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnos $modelAlumnos) // READ
    {
        return $modelAlumnos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumnos  $modelAlumnos
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumnos $modelAlumnos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumnos  $modelAlumnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumnos $Alumnos) // UPDATE
    {
        $id = $request->id;
        $alumno = alumnos::where('id', $id)->first();
        $alumno->update($request->all());
        return response()->json(['id' => $id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumnos  $modelAlumnos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Alumnos $modelAlumnos)
    {
        $modelAlumnos->destroy($id);
        return response()->json(['id' => $id], 200);
    }
}
