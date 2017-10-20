<?php

namespace TpFinal;

class Bicicleta {
    protected $matricula;
    
    public function obtener_matricula() {
        return $this->matricula;
    }
    
    public function __construct ($matricula) {
        $this->matricula = $matricula;
    }
}




