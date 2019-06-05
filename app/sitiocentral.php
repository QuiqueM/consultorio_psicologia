<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sitiocentral extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'sitiocentral';
 
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'esquema';
    protected $fillable = ['fragmento','nombre','tabla','sitio','tipo','condicion'];
}
