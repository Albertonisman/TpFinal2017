<?php

namespace TpFinal;

class Tarjeta {
    Protected $saldotarjeta;
    Protected $ult_colectivo = 0;
    public function saldo($a) {
        if ($a==332) {
                $this->saldotarjeta = $this->saldotarjeta + 388;
            }
        else {
                $this->$saldotarjeta = $this->$saldotarjeta + $a;
            }
        return 0;
    }
    public function viaje ($id){
        if($this->ult_colectivo == $id || $this->ult_colectivo == 0) {
            $this->saldotarjeta = $this->saldotarjeta - 9.75;
            $this->ult_colectivo = $id;
        }
        else {
            $this->saldotarjeta = $this->saldotarjeta - 3.20;
        }
        
    }
}
