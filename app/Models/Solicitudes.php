<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['sala_usuario', 'id_solicitado'];

    public function solicitado()
    {
        return $this->belongsTo(User::class, 'id_solicitado'); // Esta funcion es para relacionar una solicitud con un usuario
    }
}
