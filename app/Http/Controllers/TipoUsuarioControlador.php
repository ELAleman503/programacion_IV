<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuarios;
use Illuminate\Http\Request;

class TipoUsuarioControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoUsuarios  $tipoUsuarios
     * @return \Illuminate\Http\Response
     */
    public function show(TipoUsuarios $tipoUsuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoUsuarios  $tipoUsuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoUsuarios $tipoUsuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoUsuarios  $tipoUsuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoUsuarios $tipoUsuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoUsuarios  $tipoUsuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoUsuarios $tipoUsuarios)
    {
        //
    }

    public function __construct()
    {
        $tipoUsuarios = TipoUsuarios::all();
        if ($tipoUsuarios->isEmpty()) {
            $tipos = [
                ['nombre' => 'Administrador', 'descripcion' => 'Administrador del sistema'],
                ['nombre' => 'Usuario', 'descripcion' => 'Usuario del sistema'],
            ];
            TipoUsuarios::insert($tipos);
        }
        return redirect()->back();
    }
}
