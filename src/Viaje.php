<?php

namespace TpFinal;

class Viaje {
    protected $tipo; //Colectivo o bici
    protected $monto;
    protected $trasporte;
    protected $fecha_y_hora;
    public function obtener_tipo() {
       return $this->tipo;
    }
    public function obtener_monto() {
       return $this->monto;
    }
    public function obtener_transporte() {
       return $this->transporte;
    }
    public function obtener_fecha_y_hora() {
        return $this->fecha_y_hora;
    }
    public function __construct ($tipo, $monto, $transporte, $fecha) {
        $this->tipo=$tipo;
        $this->monto=$monto;
        $this->transporte=$transporte;
        $this->fecha_y_hora=$fecha;
    }
}
