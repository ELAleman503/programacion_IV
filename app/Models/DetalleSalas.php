<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSalas extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['sala_id', 'usuario_id'];

    protected $primaryKey = 'sala_id';

    public function sala()
    {
        return $this->belongsTo(Salas::class);
    }
}
