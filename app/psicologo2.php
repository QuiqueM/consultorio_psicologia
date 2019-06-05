<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psicologo2 extends Model
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
    protected $table = 'psicologo2';
    protected $fillable = ['id','nombre','telefono'];
}
