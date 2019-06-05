<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscribe2 extends Model
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
    protected $table = 'inscribe2';
    protected $fillable = ['id','id_paciente','is_evento'];
}
