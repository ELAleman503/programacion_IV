<?php

namespace App\Http\Controllers;

use App\Models\TipoSalas;
use Illuminate\Http\Request;

class TipoSalasController extends Controller
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
     * @param  \App\Models\TipoSalas  $tipoSalas
     * @return \Illuminate\Http\Response
     */
    public function show(TipoSalas $tipoSalas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoSalas  $tipoSalas
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoSalas $tipoSalas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoSalas  $tipoSalas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoSalas $tipoSalas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoSalas  $tipoSalas
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoSalas $tipoSalas)
    {
        //
    }

    public function __construct()
    {
        $tipoSalas = TipoSalas::all();
        if ($tipoSalas->isEmpty()) {
            $tipos = [
                ['nombre' => 'Chat'],
                ['nombre' => 'Grupo'],
            ];
            TipoSalas::insert($tipos);
        }
    }
}
