<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paciente2 extends Model
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
    protected $table = 'paciente2';
    protected $fillable = ['id','nombre','a_paterno','a_materno','calle','numero','colonia','edad','telefono','telefono_contacto','id_psicologo'];
}
