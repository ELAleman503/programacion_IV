<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigos extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = ['sala_usuario', 'id_amigo'];

    protected $primaryKey = 'id_amigo';

    public function solicitud()
    {
        return $this->belongsTo(Solicitudes::class, 'sala_usuario', 'id_amigo'); // Esta funcion es para relacionar una solicitud con un usuario
    }
}
