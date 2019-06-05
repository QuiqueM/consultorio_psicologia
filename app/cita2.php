<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cita2 extends Model
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
    protected $table = 'cita2';
    protected $fillable = ['id','fecha','start','end','color','textcolor','fecha','id_paciente'];
}
