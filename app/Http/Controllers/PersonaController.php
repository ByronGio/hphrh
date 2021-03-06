<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PersonaRequest;
use App\Academico;
use App\Persona;
use App\Empleado;
use App\Deudas;
use App\Experiencia;
use App\Familia;
use App\Padecimientos;
use App\Referencia;
use DB;

use Carbon\Carbon;  // para poder usar la fecha y hora
use Response;
use Illuminate\Support\Collection;

class PersonaController extends Controller
{
    //
    public function index (Request $request)
    {
    	if ($request)
    	{
    	}
    }

    public static function  getTowns(Request $request, $id)
    {
        if ($request->ajax())
        {
            $towns = DB::table('departamento as depa')
            ->join('municipio as muni','depa.iddepartamento','=','muni.iddepartamento')
            ->select ('muni.idmunicipio','muni.nombre')
            ->where('muni.iddepartamento','=',$id)
            ->get();
            return response()->json($towns);
        }
    }

    public function create()
    {
    	$departamento=DB::table('departamento')->get();
    	$estadocivil=DB::table('estadocivil')->get();
    	$puestos=DB::table('puesto')->get();
    	$afiliados=DB::table('afiliado')->get();
    	$idiomas = DB::table('idioma')->get();
        $empleado = DB::table('empleado')->get();
    	return view("persona.create",["departamento"=>$departamento,"estadocivil"=>$estadocivil,"idiomas"=>$idiomas,"puestos"=>$puestos,"afiliados"=>$afiliados,"empleado"=>$empleado]);
    }

    public function store(PersonaRequest $request)
    {
        try 
    	{
    	    DB::beginTransaction();
        //Datos persona
    	    $persona = new Persona;
    	    $persona->identificacion=$request->get('identificacion');
    	    $persona->nombre1=$request->get('nombre1');
            $persona->nombre2=$request->get('nombre2');
            $persona->nombre3=$request->get('nombre3');
    	    $persona->apellido1=$request->get('apellido1');
            $persona->apellido2=$request->get('apellido2');
            $persona->apellido3=$request->get('apellido3');
    		$persona->telefono=$request->get('telefono');
            $persona->celular=$request->get('celular');
    		$persona->fechanac=$request->get('fechanac');
            $persona->avenida=$request->get('avenida');
            $persona->calle=$request->get('calle');
            $persona->nomenclatura=$request->get('nomenclatura');
            $persona->zona=$request->get('zona');
            $persona->barriocolonia=$request->get('barriocolonia');
    		$persona->idmunicipio=$request->get('idmunicipio');
            $persona->ive=$request->get('ive');
            $persona->parientepolitico=$request->get('parientepolitico');
            //$persona->save();
            dd($persona);
        //Datos empleado
    		$empleado = new empleado;
			$empleado->identificacion= $request->get('identificacion');
        	$empleado->afiliacionigss= $request->get('afiliacionigss');
        	$empleado->tipolicencia= $request->get('tipolicencia');
        	$empleado->numerodependientes= $request->get('numerodependientes');
        	$empleado->aportemensual= $request->get('aportemensual');
        	$empleado->vivienda= $request->get('vivienda');
        	$empleado->alquilermensual= $request->get('alquilermensual');
        	$empleado->otrosingresos= $request->get('otrosingresos');
        	$empleado->pretension= $request->get('pretension');
        	$empleado->nit= $request->get('nit');
        	$mytime = Carbon::now('America/Guatemala');
        	$empleado->fechasolicitud=$mytime->toDateTimeString();
        	$empleado->idcivil= $request->get('idcivil');
        	$empleado->idpuesto= $request->get('idpuesto');
        	$empleado->idstatus='1';
        	$empleado->idafiliado= $request->get('idafiliado');
            $empleado->observacion=$request->get('observacion');
            //$empleado->save();
            //dd($persona,$empleado);
        //Datos familia
            $nombref=$request->get('nombref');
            $apellidof=$request->get('apellidof');
            $edad=$request->get('edad');
            $telefonof=$request->get('telefonof');
            $parentezco=$request->get('parentezco');
            $ocupacion=$request->get('ocupacion');
            $emergencia=$request->get('emergencia');
        //Datos academicos
            $titulo=$request->get('titulo');
            $establecimiento=$request->get('establecimiento');
            $duracion=$request->get('duracion');
            $nivel=$request->get('nivel');
            $fingreso=$request->get('fingreso');
            $fsalida=$request->get('fsalida');
            $pidmunicipio=$request->get('pidmunicipio');
        //Datos Experiencia
            $empresa=$request->get('empresa');
            $puesto=$request->get('puesto');
            $jefeinmediato=$request->get('jefeinmediato');
            $motivoretiro=$request->get('motivoretiro');
            $ultimosalario=$request->get('ultimosalario');
            $fingresoex=$request->get('fingresoex');
            $fsalidaex=$request->get('fsalidaex');
        //Datos referencias
            $nombrer=$request->get('nombrer');
            $telefonor=$request->get('telefonor');
            $profesion=$request->get('profesion');
            $tiporeferencia=$request->get('tiporeferencia');
        //Datos deudas
            $acreedor=$request->get('acreedor');
            $amortizacionmensual=$request->get('amortizacionmensual');
            $montodeuda=$request->get('montodeuda');
        //Datos padecimientos
            $nombre=$request->get('nombre');
        //contadores
    		$cont = 0;
            $conts = 0;
            $cont2 = 0;
            $cont3 = 0;
            $cont4 = 0;
            $cont5 = 0;
        //while Familia
            if ($nombref === null)
            {
                $familia = new Familia;
                $familia->nombref="ninguno";
            }
            else
            {
                while($cont3 < count($nombref))
                {
                    $familia = new Familia;
                    $familia->nombref=$nombref[$cont3];
                    $familia->apellidof=$apellidof[$cont3];
                    $familia->edad=$edad[$cont3];
                    $familia->telefonof=$telefonof[$cont3];
                    $familia->parentezco=$parentezco[$cont3];
                    $familia->ocupacion=$ocupacion[$cont3]; 
                    $familia->emergencia=$emergencia[$cont3];
                    $familia->idempleado=$empleado->idempleado;
                    $familia->identificacion=$empleado->identificacion;
                 //   $familia->save();
                    $cont3=$cont3 + 1;
                }      
            }
        //dd($persona,$empleado,$familia);
        //while Academico
            if ($titulo === null)
            {
                $academicos = new Academico;
                $academicos->titulo = "";
            }
            else 
            {
                while($cont5 < count($titulo))
                {
                    $academicos = new Academico;
                    $academicos->titulo = $titulo[$cont5];
                    $academicos->establecimiento = $establecimiento[$cont5];
                    $academicos->duracion = $duracion[$cont5];
                    $academicos->nivel = $nivel[$cont5];
                    $academicos->fingreso = $fingreso[$cont5];
                    $academicos->fsalida = $fsalida[$cont5];
                    $academicos->idmunicipio = $pidmunicipio[$cont5];
                    $academicos->idempleado = $empleado->idempleado;
                    $academicos->identificacion = $empleado->identificacion;
                   // $academicos->save();
                    $cont5=$cont5 + 1;
                }
            }         
        //dd($persona,$empleado,$familia,$academicos);
        //while Experiencia
            if ($empresa === null) 
            {
                $experiencia = new Experiencia;
                $experiencia->empresa="";
            }
            else 
            {
                while($cont4 < count($empresa))
                {
                    $experiencia = new Experiencia;
                    $experiencia->empresa=$empresa[$cont4];
                    $experiencia->puesto=$puesto[$cont4];
                    $experiencia->jefeinmediato=$jefeinmediato[$cont4];
                    $experiencia->motivoretiro=$motivoretiro[$cont4];
                    $experiencia->ultimosalario=$ultimosalario[$cont4];
                    $experiencia->fingresoex=$fingresoex[$cont4];
                    $experiencia->fsalidaex=$fsalidaex[$cont4];
                    $experiencia->idempleado=$empleado->idempleado;
                    $experiencia->identificacion=$empleado->identificacion; 
                    //$experiencia->save();
                    $cont4=$cont4 + 1;
                }    
            }            
        //dd($persona,$empleado,$familia,$academicos,$experiencia); 
        //while Referencia
           if ($nombrer === null) 
            {
                $referencia = new Referencia;
                $referencia->nombrer=$nombrer[$cont2];
            }
            else 
            {
                while($cont2 < count($nombrer))
                {
                    $referencia = new Referencia;
                    $referencia->nombrer=$nombrer[$cont2];
                    $referencia->telefonor=$telefonor[$cont2];
                    $referencia->profesion=$profesion[$cont2];
                    $referencia->tiporeferencia=$tiporeferencia[$cont2];
                    $referencia->idempleado=$empleado->idempleado;
                    $referencia->identificacion=$empleado->identificacion; 
                    //$referencia->save();
                    $cont2=$cont2 + 1;
                }
            }
        //dd($persona,$empleado,$familia,$academicos,$experiencia,$referencia);
        //while deudas
            if ($acreedor === null) 
            {
                $deuda = new Deudas;
                $deuda->acreedor="";
            }
            else 
            {
                while($conts < count($acreedor))
                {
                    $deuda = new Deudas;
                    $deuda->acreedor=$acreedor[$conts];
                    $deuda->amortizacionmensual=$amortizacionmensual[$conts];
                    $deuda->montodeuda=$montodeuda[$conts];
                    $deuda->idempleado=$empleado->idempleado;
                    $deuda->identificacion=$empleado->identificacion; 
                    //$deuda->save();
                    $conts=$conts + 1;
                }
            }            
        //dd($persona,$empleado,$familia,$academicos,$experiencia,$referencia,$deuda);
        //while padecimientos
            if ($nombre === null) 
            {
                $padecimiento= new Padecimientos;
                $padecimiento->nombre = " ";
            }
            else 
            {
                while($cont < count($nombre))
                {
                    $padecimiento= new Padecimientos;
                    $padecimiento->nombre = $nombre[$cont];
                    $padecimiento->idempleado = $empleado->idempleado;
                    $padecimiento->identificacion = $empleado->identificacion;
                    //$padecimiento->save();
                    $cont=$cont + 1;
                }
            }
        //dd($persona,$empleado,$familia,$academicos,$experiencia,$referencia,$deuda,$padecimiento);
        //dd($persona,$empleado,$familia,$padecimiento);
        //commit
    		DB::commit();
    		
    	}catch (\Exception $e) 
    	{
    		DB::rollback();    		
    	}
    	return Redirect::to('persona');
    }

}
