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
    public function reiniciosaldo() {
        $this->saldo = 0;
        $this->ult_colectivo = 0;
    }
    public function saldotarjeta() {
        return $this->saldo;
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
    public function viaje ($Transporte){
        $Time = time();
        if(get_class($Transporte) == 'TpFinal\Colectivo') {
            if(is_null($this->ult_colectivo)) {
                $this->saldo = $this->saldo - 9.75;
                array_unshift(($this->viajes_realizados), new Viaje("Normal", 9.75, $Transporte));
                $this->ult_colectivo = $Transporte;
            }
            else {
                if( $this->ult_colectivo->obtener_linea() == $Transporte->obtener_linea()){
                    $this->saldo = $this->saldo - 9.75;
                    array_unshift(($this->viajes_realizados), new Viaje("Normal", 9.75, $Transporte));
                }
                else {
                    $this->saldo = $this->saldo - 3.20;
                    array_unshift($this->viajes_realizados, new Viaje("Trasbordo", 3.20, $Transporte));
                    $this->ult_colectivo = $Transporte;
                }
            }
        }
        else {
            if($this->dia != date("F j, Y")) {
                $this->saldo = $this->saldo - 14.625;
                $this->dia = date("F j, Y");
                array_unshift($this->viajes_realizados, new Viaje("Bicicleta", 14.625, $Transporte));
            }
            else {
                array_unshift($this->viajes_realizados, new Viaje("Bicicleta", 0.0, $Transporte));
            }
        }
    }
}


