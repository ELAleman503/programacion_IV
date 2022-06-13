<?php

namespace App\Http\Controllers;

use App\Models\Amigos;
use App\Models\User;
use App\Models\Solicitudes;
use App\Models\Salas;
use App\Models\TipoSalas;
use App\Models\VisibilidadSalas;
use App\Models\DetalleSalas;
use Illuminate\Http\Request;

class AmigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amigos = [];
        $amistades = Amigos::where('sala_usuario', auth()->id())->orWhere('id_amigo', auth()->id())->get();
        foreach ($amistades as $key => $value) {
            if ($value->sala_usuario != auth()->id()) {
                $amigos[] = User::find($value->sala_usuario);
            } else if ($value->id_amigo != auth()->id()) {
                $amigos[] = User::find($value->id_amigo);
            }
        }
        return $amigos;
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
        $solicitud = Solicitudes::where('sala_usuario', $request->usuario)->where('id_solicitado', auth()->id());
        if ($solicitud) {
            $amigo = new Amigos();
            $amigo->sala_usuario = auth()->id();
            $amigo->id_amigo = $request->usuario;
            $amigo->save();

            $tipo_salas = TipoSalas::all();
            $visibilidad_salas = VisibilidadSalas::all();
            if (count($tipo_salas) == 0) {
                $tipos = ['Chat', 'Grupo'];
                foreach ($tipos as $key => $value) {
                    $tipo = new TipoSalas();
                    $tipo->nombre = $value;
                    $tipo->save();
                }
            }
            if (count($visibilidad_salas) == 0) {
                $visibilidades = ['Privada', 'Pública'];
                foreach ($visibilidades as $key => $value) {
                    $visibilidad = new VisibilidadSalas();
                    $visibilidad->nombre = $value;
                    $visibilidad->save();
                }
            }
            $sala = new Salas();
            $sala->nombre = 'chat';
            $sala->tipo_sala = 1;
            $sala->visibilidad_sala = 1;
            $sala->save();
            $detalle_sala = new DetalleSalas();
            $detalle_sala->sala_id = $sala->id;
            $detalle_sala->usuario_id = auth()->id();
            $detalle_sala->save();
            $detalle_sala = new DetalleSalas();
            $detalle_sala->sala_id = $sala->id;
            $detalle_sala->usuario_id = $request->usuario;
            $detalle_sala->save();
            
            $solicitud->delete();
            return response()->json(['mensaje' => 'Amigo agregado correctamente', 'dismissible' => false]);
        } else {
            return response()->json(['mensaje' => 'No existe la solicitud', 'dismissible' => true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amigos  $amigos
     * @return \Illuminate\Http\Response
     */
    public function show(Amigos $amigos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amigos  $amigos
     * @return \Illuminate\Http\Response
     */
    public function edit(Amigos $amigos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amigos  $amigos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amigos $amigos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amigos  $amigos
     * @return \Illuminate\Http\Response
     */
    public function borrar(Amigos $amigos, Request $id)
    {
        $amigo = Amigos::where('sala_usuario', $id->usuario)->where('id_amigo', auth()->id())->latest()->orWhere('sala_usuario', auth()->id())->where('id_amigo', $id->usuario)->get();
        if ($amigo) {
            $detalle_sala = DetalleSalas::where('usuario_id', auth()->id())->orWhere('usuario_id', $id->usuario)->get();
            if ($detalle_sala) {
                $sala = Salas::find($detalle_sala[0]->sala_id);
                if ($sala) {
                    foreach ($detalle_sala as $key => $value) {
                        $value->delete();
                    }
                    $sala->delete();
                }
            } else {
                return response()->json(['mensaje' => 'No existe la sala', 'dismissible' => true]);
            }
            foreach ($amigo as $amigo) {
                $amigo->delete();
            }
            return response()->json(['mensaje' => 'Amigo eliminado correctamente', 'dismissible' => false]);
        } else {
            return response()->json(['mensaje' => 'No existe el amigo', 'dismissible' => true]);
        }
    }
}
