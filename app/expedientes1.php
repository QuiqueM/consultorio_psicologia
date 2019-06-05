<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expedientes1 extends Model
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
    protected $table = 'expedientes1';
    protected $fillable = ['id','avance','notas','fecha','situacion','id_paciente'];
}
