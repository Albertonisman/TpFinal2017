<?php

namespace TpFinal;

class Tarjeta {
    protected $saldo = 0;
    protected $ult_viaje;
    protected $dia;
    public function reiniciosaldo() {
        $this->saldo = 0;
        $this->ult_viaje = new Viaje("-",0,"-");
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
    public function viaje ($id){
        if($this->ult_viaje->obtener_trasporte() == $id || $this->ult_viaje->obtener_trasporte() == "-") {
            $this->saldo = $this->saldo - 9.75;
            $this->ult_viaje = new Viaje("Colectivo", 9.75, $id);
        }
        else {
            $this->saldo = $this->saldo - 3.20;
            $this->ult_viaje = new Viaje("Colectivo", 3.20, $id);
        }
        
    }
    public function alquilerbici() {
        if($this->dia != date("F j, Y")) {
            $this->saldo = $this->saldo - 14.625;
            $this->dia = date("F j, Y");
        }
    }
}
