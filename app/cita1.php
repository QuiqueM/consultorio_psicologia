<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cita1 extends Model
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
    protected $table = 'cita1';
    protected $fillable = ['id','title','start','end','color','textcolor','fecha','id_psicologo'];
}
