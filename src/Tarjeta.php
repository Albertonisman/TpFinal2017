<?php

namespace TpFinal;

include 'Viaje.php';

class Tarjeta {
    protected $saldo = 0;
    protected $ult_colectivo = 0;
    protected $ult_viaje;
    protected $dia;
    public function reiniciosaldo() {
        $this->saldo = 0;
    }
    public function saldotarjeta() {
        return $this->saldo;
    }
    public function ultimo_viaje() {
    	return $this->ult_viaje->obtener_trasporte();
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
    public function viaje ($Trasporte){
        if($this->ult_colectivo == $Trasporte || $this->ult_colectivo == 0) {
            $this->saldo = $this->saldo - 9.75;
            $this->ult_viaje = new Viaje("Normal", 9.75, $Trasporte);
        }
        else {
            $this->saldo = $this->saldo - 3.20;
            $this->ult_viaje = new Viaje("Trasbordo", 3.20, $Trasporte);
        }
        
    }
    public function alquilerbici() {
        if($this->dia != date("F j, Y")) {
            $this->saldo = $this->saldo - 14.625;
            $this->dia = date("F j, Y");
        }
    }
}

