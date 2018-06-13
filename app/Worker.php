<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    //
    use SoftDeletes;

    protected $softDelete = true;

    protected $fillable = ['name','worker_id','companie_id','department','position','user_id','status'];

    public function company()
    {
        return $this->belongsTo(Companie::class, 'companie_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    } 

    public function hasEntry($type)
    {
        # code...   
        $operation = Operation::where('name','LIKE','%'.$type.'%')->first();
        $type = $operation->id;

        $entry = Entrie::whereDate('date',date('Y-m-d'))
                    ->where('companie_id',$this->companie_id)
                    ->where('person_id',$this->worker_id)
                    ->where('operation_id',$type)
                    ->get();
        //dd($entry);
        return ($entry->isEmpty()) ? false : true;
    }

    public function getEntry($type)
    {
        $operation = Operation::where('name','LIKE','%'.$type.'%')->first();
        $type = $operation->id;

        $entry = Entrie::whereDate('date',date('Y-m-d'))
                    ->where('companie_id',$this->companie_id)
                    ->where('person_id',$this->worker_id)
                    ->where('operation_id',$type)
                    ->first();

        return (empty($entry)) ? null : $entry->time;
    }

    public function timeView($value)
    {
        return date("g:i A", strtotime($value));
    }

    public function getDepartment($code)
    {
        # code...
        switch ($code) {
            case 'ADM':
                return 'ADMINISTRACIÓN';
                break;
            case 'ADM-MOR':
                return 'Administracion Moron';
                break;
            case 'ALM':
                return 'ALMACÉN';
                break;
            case 'ALM-MOR':
                return 'Almacen Moron';
                break;
            case 'CNTB':
                return 'CONTABILIDAD';
                break;
            case 'COM-MOR':
                return 'Compras Moron';
                break;
            case 'CONS':
                return 'CONSTRUCCIÓN';
                break;
            case 'COODOPERA':
                return 'COORDINACION DE OPERACIONES';
                break;
            case 'COORCOMVEN':
                return 'COORDINACION DE COMPRA Y VENTA';
                break;
            case 'COORDFACT':
                return 'COORDINACION DE FACTURACION' ;
                break;
            case 'COORSEGU':
                return 'COORDINACION DE SEGURIDAD' ;
                break;
            case 'GER':
                return 'GERENCIA';
                break;
            case 'GER-CAL':
                return 'Gerencia Control y Calidad';
                break;
            case 'GERCOM':
                return 'GERENCIA DE COMERZIALIZACIÓN';
                break;
            case 'GER-COM':
                return 'Gerencia de Comercializacion';
                break;
            case 'GER-OPE':
                return 'Gerencia de Operaciones';
                break;
            case 'GERPLAN':
                return 'Gerencia de Planta';
                break;
            case 'ING':
                return 'INGENIERIA';
                break;
            case 'MAN':
                return 'Mantenimiento';
                break;
            case 'MANGEN':
                return 'Mantenimiento General y Limpieza';
                break;
            case 'MANOPE':
                return 'Mantenimiento de Operaciones';
                break;
            case 'MANT':
                return 'MANTENIMIENTO Y LIMPIEZA';
                break;
            case 'OPE':
                return 'Operaciones';
                break;
            case 'OPE-MOR':
                return 'Operaciones Moron';
                break;
            case 'OPELOG':
                return 'Operaciones y Logistica de Transporte';
                break;
            case 'OPEPRO':
                return 'Operaciones de Procesos';
                break;
            case 'OPERAC':
                return 'OPERACIONES' ;
                break;
             case 'OPESER':
                return 'Operaciones y Servicios';
                break;
            case 'PRO':
                return 'Produccion';
                break;
            case 'PRO-MOR':
                return 'Produccion Moron';
                break;
            case 'REGFAR':
                return 'REGENCIA FARMACEUTICA' ;
                break;
            case 'SEG':
                return 'Seguridad';
                break;
            case 'SEG-MOR':
                return 'Seguridad Moron';
                break;
            case 'SEGIND':
                return 'Seguridad Industrial';
                break;
            case 'SEGPAT':
                return 'Seguridad Patrimonial';
                break;
            case 'SEGUR':
                return 'SEGURIDAD';
                break;
            case 'SIST':
                return 'SISTEMAS';
                break;
            case 'SIST-MOR':
                return 'Sistema y Tecnologia';
                break;
            case 'SIST-VAL':
                return 'Sistema y Tecnologia';
                break;
            case 'VEN':
                return 'Ventas';
                break;
            case 'VEN-MOR':
                return 'Ventas  Moron';
                break;
            case 'VTA':
                return 'VENTAS';
                break;
            default:
                return '';
                break;
        }
        
    }    

    public function getPosition($code)
    {
        # code...
        switch ($code) {
            case 'ACTICO':
                return 'ACTIVADOR DE COMPRAS';
                break;
            case 'ANACON':
                return 'ANALISTA CONTABLE';
                break;
            case 'ANLOGEX':
                return 'ANALISTA DE LOGISTICA Y EXPORTACION';
                break;           
            case 'ASELEG':
                return 'ASESOR LEGAL';
                break;
            case 'APREIN':
                return 'APRENDIZ INCE';
                break;
            case 'ASIAD':
                return 'ASISTENTE ADMINISTRATIVO';
                break;
            case 'ASIADM':
                return 'ASISTENTE ADMINISTRATIVO';
                break;
            case 'ASISEJEC':
                return 'ASISTENTE EJECUTIVO';
                break;
            case 'ASISLOG':
                return 'ASISTENTE DE LOGISTICA';
                break;
            case 'ASISTCOM':
                return 'ASISTENTE DE COMPRA';
                break;
            case 'ASIS.TEC.M':
                return 'ASISTENTE TÉCNICO MECANICO';
                break;
            case 'ASIST.':
                return 'ASISTENTE ADMINISTRATIVO';
                break;
            case 'AUXALM':
                return 'AUXILIAR DE ALMACEN';
                break;
            case 'AUXLOG':
                return 'AUXILIAR DE LOGISTICA Y ALMACEN';
                break;
            case 'AYUINT':
                return 'AYUDANTE INTEGRAL';
                break;
            case 'AYUCOC':
                return 'AYUDANTE DE COCINA';
                break;
            case 'AYUFUN':
                return 'AYUDANTE DE FUNDICION';
                break;
            case 'AYUGEN':
                return 'AYUDANTE GENERAL';
                break;
            case 'AYUINT':
                return 'AYUDANTE INTEGRAL';
                break;
            case 'COADM':
                return 'COORDINADORA DE ADMINISTRACION';
                break;
            case 'COCOMP':
                return 'COORDINADOR DE COMPRAS';
                break;
            case 'CHOFER':
                return 'CHOFER';
                break;
            case 'COLOAL':
                return 'COORDINADOR DE LOGISTICA Y ALMACEN';
                break;
            case 'COMAME':
                return 'COORDINADOR DE MANTENIMIENTO MECANICO';
                break;
            case 'CON-JUNIOR':
                return 'CONSULTOR JUNIOR';
                break;
            case 'COOCONT':
                return 'COORDINADORA DE CONTABILIDAD';
                break;
            case 'COOLOG':
                return 'COORDINADOR DE LOGISTICA';
                break;
            case 'COOMANTG':
                return 'COORDINADOR DE MANTENIMIENTO GENERAL';
                break;
            case 'COOPRO':
                return 'COORDINADOR DE PROYECTOS';
                break;
            case 'COORD-ADM':
                return 'COORDINADOR ADMINISTRATIVO';
                break;
            case 'COOSOL':
                return 'COORDINADOR DE SOLDADURAS';
                break;
            case 'COSEIN':
                return 'COORDINADOR DE SEGURIDAD INDUSTRIAL';
                break;
            case 'DIRGEN':
                return 'DIRECTOR GENERAL';
                break;
            case 'DISEPA':
                return 'DIRECTOR DE SEGURIDAD PATRIMONIAL';
                break;
            case 'FACTUR':
                return 'FACTURADOR';
                break;
            case 'GECOCA':
                return 'GERENTE DE CONTROL DE CALIDAD';
                break;
            case 'GECONFI':
                return 'GERENTE DE CONTABILIDAD Y FINANZAS';
                break;
            case 'GEGEPLA':
                return 'GERENTE GENERAL DE PLANTA';
                break;
            case 'GER-OPE':
                return 'GERENTE DE OPERACIONES';
                break;
            case 'GERDCOM':
                return 'GERENTE DE COMERCIALIZACIÓN';
                break;
            case 'GERESC':
                return 'GERENTE DE LINEA DE ESCORIA';
                break;
            case 'GERGEN':
                return 'GERENTE GENERAL';
                break;
            case 'GTE-ADM':
                return 'GERENTE DE ADMINISTRACIÓN';
                break;
            case 'GTE-CNTB':
                return 'GERENTE DE CONTABILIDAD';
                break;
            case 'GTE-OPER':
                return 'GERENTE DE OPERACIONES';
                break;
            case 'GTE-SIST':
                return 'GERENTE DE SISTEMAS';
                break;
            case 'GTE.VTA':
                return 'GERENTE DE VENTAS';
                break;
            case 'JECONT':
                return 'JEFE DE CONTABILIDAD';
                break;
            case 'JEF-OPER':
                return 'JEFE DE OPERACIONES';
                break;
            case 'JEFCOC':
                return 'JEFE DE COCINA';
                break;
            case 'JEFSEGU':
                return 'JEFE DE SEGURIDAD';
                break;
            case 'JEFFUN':
                return 'JEFE DE FUNDICION';
                break;
            case 'MANTEN':
                return 'MANTENIMIENTO';
                break;
            case 'MEC':
                return 'MECANICOS';
                break;
            case 'MEC1RA':
                return 'MECANICO DE 1RA';
                break;
            case 'MEC3RA':
                return 'MECANICO DE 3RA';
                break;
            case 'MENSA':
                return 'MENSAJERO';
                break;
            case 'OPEFUN':
                return 'OPERADOR DE FUNDICION';
                break;
            case 'OPEHOR':
                return 'OPERADOR DE HORNO';
                break;
            case 'OPEMA1RA':
                return 'OPERADOR DE MAQUINARIA PESADA DE 1RA';
                break;
            case 'OPEMA2DA':
                return 'OPERADOR DE MAQUINARIA PESADA DE 2DA';
                break;
            case 'OPEMAQ':
                return 'OPERADOR DE MAQUINARIAS';
                break;
            case 'OPERESC':
                return 'OPERADOR LINEA ESCORIA';
                break;
            case 'PASA':
                return 'PASANTE';
                break;
            case 'REGFAC':
                return 'REGENTE FARMACEUTICO';
                break;
            case 'ROMAN':
                return 'ROMANERO';
                break;
            case 'SEG':
                return 'SEGURIDAD';
                break;
            case 'SUPALM':
                return 'SUPERVISOR DE ALMACEN (2)';
                break;
             case 'SUPFUN':
                return 'SUPERVISOR DE FUNDICION 1';
                break;
            case 'SUPFUN2':
                return 'SUPERVISOR DE FUNDICION 2';
                break;
            case 'SUPFUN3':
                return 'SUPERVISOR DE FUNDICION 3';
                break;
            case 'SUPRO':
                return 'SUPERVISOR GENERAL DE PRODUCCION';
                break;
            case 'SUPSEG':
                return 'SUPERVISOR DE SEGURIDAD';
                break;            
            case 'TALL.AYU':
                return 'AYUDANTE DE TALLER';
                break;
            case 'VEND':
                return 'VENDEDOR';
                break; 
            default:
                return '';
                break;
        }
    } 
}