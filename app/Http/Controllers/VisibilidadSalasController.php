<?php

namespace App\Http\Controllers;

use App\Models\VisibilidadSalas;
use Illuminate\Http\Request;

class VisibilidadSalasController extends Controller
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
     * @param  \App\Models\VisibilidadSalas  $visibilidadSalas
     * @return \Illuminate\Http\Response
     */
    public function show(VisibilidadSalas $visibilidadSalas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisibilidadSalas  $visibilidadSalas
     * @return \Illuminate\Http\Response
     */
    public function edit(VisibilidadSalas $visibilidadSalas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisibilidadSalas  $visibilidadSalas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisibilidadSalas $visibilidadSalas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisibilidadSalas  $visibilidadSalas
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisibilidadSalas $visibilidadSalas)
    {
        //
    }

    public function __construct()
    {
        $visibilidadSalas = VisibilidadSalas::all();
        if ($visibilidadSalas->isEmpty()) {
            $visibilidades = [
                'publico' => 'Público',
                'privado' => 'Privado',
            ];
            VisibilidadSalas::insert($visibilidades);
        }
    }
}
