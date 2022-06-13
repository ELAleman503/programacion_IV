<?php

namespace App\Http\Controllers;

use App\Models\TipoMensajes;
use Illuminate\Http\Request;

class TipoMensajesController extends Controller
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
     * @param  \App\Models\TipoMensajes  $tipoMensajes
     * @return \Illuminate\Http\Response
     */
    public function show(TipoMensajes $tipoMensajes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoMensajes  $tipoMensajes
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMensajes $tipoMensajes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoMensajes  $tipoMensajes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMensajes $tipoMensajes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoMensajes  $tipoMensajes
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMensajes $tipoMensajes)
    {
        //
    }

    public function __construct()
    {
        $tipoMensajes = TipoMensajes::all();
        if ($tipoMensajes->isEmpty()) {
            $tipos = [
                ['nombre' => 'Texto'],
                ['nombre' => 'Imagen'],
                ['nombre' => 'Video'],
                ['nombre' => 'Audio'],
                ['nombre' => 'Archivo'],
            ];
            TipoMensajes::insert($tipos);
        }
    }
}
