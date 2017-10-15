<?php

namespace TpFinal;

class Tarjeta {
    protected $saldo_tarjeta = 0;
    protected $ult_colectivo = 0;
    public function reiniciosaldo() {
        $this->saldo_tarjeta = 0;
    }
    public function saldotarjeta() {
        return $this->saldo_tarjeta;
    }
    public function saldo($a) {
        if ($a==332) {
                $this->saldo_tarjeta = $this->saldo_tarjeta + 388;
            }
        else {
                $this->saldo_tarjeta = $this->saldo_tarjeta + $a;
            }
        return 0;
    }
    public function viaje ($id){
        if($this->ult_colectivo == $id || $this->ult_colectivo == 0) {
            $this->saldo_tarjeta = $this->saldo_tarjeta - 9.75;
            $this->ult_colectivo = $id;
        }
        else {
            $this->saldo_tarjeta = $this->saldo_tarjeta - 3.20;
        }
        
    }
    public function alquilerbici() {
        $this->saldo_tarjeta = $this->saldotarjeta - 14.625;
        $dia = date("F j, Y");
    }
}
