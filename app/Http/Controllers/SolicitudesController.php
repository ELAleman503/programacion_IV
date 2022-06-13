<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enviadas = User::selectRaw('users.*, solicitudes.created_at AS fecha_solicitud')
            ->join('solicitudes', 'solicitudes.id_solicitado', '=', 'users.id')
            ->where('solicitudes.sala_usuario', auth()->id())
            ->orderBy('fecha_solicitud', 'desc')
            ->get();
        $recibidas = User::selectRaw('users.*, solicitudes.created_at AS fecha_solicitud')
            ->join('solicitudes', 'solicitudes.sala_usuario', '=', 'users.id')
            ->where('solicitudes.id_solicitado', auth()->id())
            ->orderBy('fecha_solicitud', 'desc')
            ->get();
        return ['enviadas' => $enviadas, 'recibidas' => $recibidas];
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
        $solicitud = new Solicitudes();
        $solicitud->sala_usuario = auth()->id();
        $solicitud->id_solicitado = $request->usuario;
        if ($solicitud->save()) {
            return response()->json(['mensaje' => 'Solicitud enviada correctamente', 'dismissible' => false]);
        } else {
            return response()->json(['mensaje' => 'Error al enviar la solicitud', 'dismissible' => true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitudes $solicitudes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitudes $solicitudes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitudes $solicitudes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function borrar(Solicitudes $solicitudes, Request $request)
    {
        if ($request->enviado) {
            $solicitud = Solicitudes::where('sala_usuario', auth()->id())->where('id_solicitado', $request->usuario);
            if ($solicitud->delete()) {
                return response()->json(['mensaje' => 'Solicitud cancelada', 'dismissible' => false]);
            } else {
                return response()->json(['mensaje' => 'Error al cancelar la solicitud', 'dismissible' => true]);
            }
        } else {
            $solicitud = Solicitudes::where('sala_usuario', $request->usuario)->where('id_solicitado', auth()->id());
            if ($solicitud->delete()) {
                return response()->json(['mensaje' => 'Solicitud rechazada', 'dismissible' => false]);
            } else {
                return response()->json(['mensaje' => 'Error al rechazar la solicitud', 'dismissible' => true]);
            }
        }
    }
}
