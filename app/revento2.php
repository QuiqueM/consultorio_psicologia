<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class revento2 extends Model
{
     /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'sitio2';
 
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'revento2';
    protected $fillable = ['id','nombre','ubicacion','fecha','imagen','hora','descripcion','id_psicologo'];
}
