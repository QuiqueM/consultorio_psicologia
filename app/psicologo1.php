<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psicologo1 extends Model
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
    protected $table = 'psicologo1';
    protected $fillable = ['id','titulo','especialidad'];
}