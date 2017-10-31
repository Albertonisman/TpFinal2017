<?php

namespace TpFinal;

include 'Viaje.php';
include 'Colectivo.php';
include 'Bicicleta.php';

class Tarjeta {
    protected $saldo = 0;
    protected $ult_colectivo;
    protected $viajes_realizados = array();
    protected $dia;
    protected $dia_colectivo;
    protected $plus = 0;
    public function reiniciosaldo() {
        $this->saldo = 0;
        $this->ult_colectivo = NULL;
    }
    public function saldotarjeta() {
        return $this->saldo;
    }
    public function plusTarjeta() {
        return $this->plus;
    }
    public function cargar_saldo($a) {
        if ($a==332) {
                $this->saldo = $this->saldo + 388;
            }
        else {
                if($a==624) {
                    $this->saldo = $this->saldo + 776;
                }
                else {
                    $this->saldo = $this->saldo + $a;
                }
            }
        return 0;
    }
    public function viaje ($Transporte, $fecha){
        $fecha = strtotime($fecha);
        if(get_class($Transporte) == 'TpFinal\Colectivo') {
            if(is_null($this->ult_colectivo)) {
                if($this->saldo > 9.75){
                    if($this->plus > 0) {
                        $this->saldo = $this->saldo - (9.75 + 9.75*$this->plus) ;
                        array_unshift(($this->viajes_realizados), new Viaje("Normal", 9.75+9.75*$this->plus, $Transporte->obtener_linea())); 
                    } 
                    else {
                        $this->saldo = $this->saldo - 9.75;
                        array_unshift(($this->viajes_realizados), new Viaje("Normal", 9.75, $Transporte->obtener_linea())); 
                    }
                }
                else {
                    if($this->plus < 2) {
                        $this->plus = $this->plus + 1;
                        array_unshift(($this->viajes_realizados), new Viaje("Plus " .  ($this->plus+1), 9.75, $Transporte->obtener_linea()));
                    }
                    else {
                        print ("No puede realizar el viaje"); //no se me ocurre otra forma de hacerlo mejor si no pude realizar el viaje 
                    }
                }
                
                $this->ult_colectivo = $Transporte;
            }
            else {
                if( $this->ult_colectivo->obtener_linea() == $Transporte->obtener_linea() || ($fecha-strtotime($this->dia_colectivo))>3600 ) {
                    $this->saldo = $this->saldo - 9.75;
                    array_unshift(($this->viajes_realizados), new Viaje("Normal", 9.75, $Transporte->obtener_linea()));
                }
                else {
                    $this->saldo = $this->saldo - 3.20;
                    array_unshift($this->viajes_realizados, new Viaje("Trasbordo", 3.20, $Transporte->obtener_linea()));
                    $this->ult_colectivo = $Transporte;
                }
            }
            $this->dia_colectivo = $fecha;    
        }
        else {
            if($this->dia != $fecha) {
                $this->saldo = $this->saldo - 14.625;
                $this->dia = $fecha;
                array_unshift($this->viajes_realizados, new Viaje("Bicicleta", 14.625, $Transporte->obtener_matricula()));
            }
            else {
                array_unshift($this->viajes_realizados, new Viaje("Bicicleta", 0.0, $Transporte));
            }
        }
    }
}

echo strtotime('01/01/2017 20:00');
echo time();