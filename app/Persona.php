<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table='persona';
    protected $primarykey='identificacion';

    public $timestamps=false;
    
    protected $fillable =[
    	'nombre1',
        'nombre2',
        'nombre3',
    	'apellido1',
        'apellido2',
        'apellido3',
    	'telefono',
        'celular',
        'fechanac',
        'avenida',
        'calle',
        'nomenclatura',
        'zona',
        'barriocolonia',    	
    	'idmunicipio',
        'ive',
        'parientepolitico',
        'finiquito'
    ];

    protected $guarder =[

    ];
}
