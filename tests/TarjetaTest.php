<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testSaldoCero() {
        $tarjeta = new Tarjeta;
        $tarjeta->saldotarjeta=0;
    }
        $tarjeta->saldo(50);
        $this->assertEquals($tarjeta->saldotarjeta, 50);
        $tarjeta->saldotarjeta=0;
        $tarjeta->saldo(332)
        $this->assertEquals($tarjeta->saldotarjeta,388);
        $tarjeta->viaje(145);
        $this->asserEquals($tarjeta->saldotarjeta,388-9.75);
        $tarjeta->viaje(145);
        $this->asserEquals($tarjeta->saldotarjeta,388-19.50);
        $tarjeta->viaje(133);
        $this->asserEquals($tarjeta->saldotarjeta,388-22.70);
        
}
