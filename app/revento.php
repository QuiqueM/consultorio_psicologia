<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class revento extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'sitio1';
 
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'revento';
    protected $fillable = ['id','nombre','ubicacion','fecha','hora','imagen','descripcion','id_psicologo'];
}
