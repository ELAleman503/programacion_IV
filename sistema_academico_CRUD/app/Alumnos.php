<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    protected $fillable = ['idAlumno','codigo','nombre','fechaNacimiento','direccion','telefono','dui'];
}
