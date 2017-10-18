<?php

namespace TpFinal;

class Colectivo {
    protected $linea;
    
    public function obtener_linea() {
        return $this->linea;
    }
    
    public function __construct ($linea) {
        $this-linea = $linea;
    }
}




