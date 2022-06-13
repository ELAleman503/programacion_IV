<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Solicitudes;
use App\Models\Amigos;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '!=', auth()->id())->get();
        foreach ($user as $key => $value) {
            $value->solicitud = false;
            $value->recibido = false;
            $value->amigo = false;
            $solicitudes = Solicitudes::where('sala_usuario', auth()->id())->where('id_solicitado', $value->id)->get();
            if (count($solicitudes) > 0) {
                $value->solicitud = true;
            }
            $recibidos = Solicitudes::where('sala_usuario', $value->id)->where('id_solicitado', auth()->id())->get();
            if (count($recibidos) > 0) {
                $value->recibido = true;
            }
            $amigos = Amigos::where('sala_usuario', auth()->id())->where('id_amigo', $value->id)->get();
            if (count($amigos) > 0) {
                $value->amigo = true;
            }
            $amigos = Amigos::where('sala_usuario', $value->id)->where('id_amigo', auth()->id())->get();
            if (count($amigos) > 0) {
                $value->amigo = true;
            }
        }
        return $user;
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
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(User $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $users)
    {
        //
    }
}
