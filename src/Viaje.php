<?php

namespace tpFinal;

class Viaje {
    protected $tipo;
    protected $monto;
    protected $trasporte;
    
    public function obtener_tipo() {
       return $this->tipo;
    }
    
    public function obtener_monto() {
       return $this->monto;
    }
    
    public function obtener_transporte() {
       return $this->transporte;
    }
    
    public function __construct ($tipo, $monto, $transporte) {
        $this->tipo=$tipo;
        $this->monto=$monto;
        $this->transporte=$transporte;
    }
}
