<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    protected $fillable = ['idMateria','codigo','nombre','docente','de','a','dia','aula'];
}
