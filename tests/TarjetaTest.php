<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testSaldoCero() {
        $tarjeta = new Tarjeta;
        $tarjeta->cargar_saldo(50);
        $this->assertEquals($tarjeta->saldotarjeta(), 50);
        $tarjeta->reiniciosaldo();
        $tarjeta->cargar_saldo(624);
        $this->assertEquals($tarjeta->saldotarjeta(),776);
        $tarjeta->reiniciosaldo();
        //Reinicio la carga en la tarjeta para simplificar los test
        $tarjeta->cargar_saldo(332);
        $this->assertEquals($tarjeta->saldotarjeta(),388);
        $tarjeta->viaje(145);
        $this->assertEquals($tarjeta->saldotarjeta(),388-9.75);
        //Hago un segundo viaje en el mimso colectivo
        $tarjeta->viaje(145);
        $this->assertEquals($tarjeta->saldotarjeta(),388-19.50);
        //Ahora hago un transbordo
        $tarjeta->viaje(133);
        $this->assertEquals($tarjeta->saldotarjeta(),388-22.70);
        //Reinicio la carga en la tarjeta para simplificar los test
        $tarjeta->reiniciosaldo();
        //Ahora hacemos 1 viaje un transbordo y pagar un viaje a otra persona (9.75+ 3.2 + 9.75)
        $tarjeta->cargar_saldo(332);
        $tarjeta->viaje(139);
        $tarjeta->viaje(145);
        $tarjeta->viaje(145);
        $this->assertEquals($tarjeta->saldotarjeta(),388-22.70);
        //Reinicio el saldo
        $tarjeta->reiniciosaldo();
        $tarjeta->cargar_saldo(332);
        //Alquilo una bici
        $tarjeta->alquilerbici();
        $this->assertEquals($tarjeta->saldotarjeta(),388-14.625);
        $tarjeta->alquilerbici();
        $this->assertEquals($tarjeta->saldotarjeta(),388-14.625);
        
    }
}
