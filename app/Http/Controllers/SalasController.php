<?php

namespace App\Http\Controllers;

use App\Models\Salas;
use App\Models\DetalleSalas;
use App\Models\User;
use Illuminate\Http\Request;

class SalasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salas = Salas::selectRaw('salas.*')
            ->join('detalle_salas', 'detalle_salas.sala_id', '=', 'salas.id')
            ->where('detalle_salas.usuario_id', auth()->id())
            ->get();
        foreach ($salas as $key => $value) {
            $detalle_salas = DetalleSalas::selectRaw('users.*')
                ->join('users', 'users.id', '=', 'detalle_salas.usuario_id')
                ->where('detalle_salas.sala_id', $value->id)
                ->where('detalle_salas.usuario_id', '!=', auth()->id())
                ->get();
            $value->detalle_salas = $detalle_salas;
        }
        return $salas;

        return $detalle_salas;
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
     * @param  \App\Models\Salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function show(Salas $salas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function edit(Salas $salas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salas $salas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salas $salas)
    {
        //
    }
}
