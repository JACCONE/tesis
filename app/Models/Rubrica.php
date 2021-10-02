<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
    use HasFactory;
    //protected $primaryKey = 'id_rubrica';
    protected $table = 'rubricas';
    //protected $guarded = [];  
    //protected $fillable = ['id','id_asignatura','id_docente','nombre','descripcion','estado'];
}
