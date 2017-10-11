<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testSaldoCero() {
        $tarjeta = new Tarjeta;
        $recarga = 50;
        $this->assertEquals($tarjeta->saldo($recarga), 50);
        $tarjeta->saldotarjeta=0;
        $this->assertEquals($tarjeta->saldo(332),388);
        $tarjeta->viaje();
        $this->asserEquals($tarjeta->saldotarjeta,388-9.75);
        
    }
}
