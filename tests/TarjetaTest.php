<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testCargarSaldo() {
        $tarjeta = new Tarjeta;
        $tarjeta->cargar_saldo(50);
        $this->assertEquals($tarjeta->saldotarjeta(), 50);
        $tarjeta->reiniciosaldo();
        $tarjeta->cargar_saldo(332);
        $this->assertEquals($tarjeta->saldotarjeta(),388);
        $tarjeta->reiniciosaldo();
        $tarjeta->cargar_saldo(624);
        $this->assertEquals($tarjeta->saldotarjeta(),776);
    }
    public function testViaje() {
        $tarjeta = new Tarjeta;
        $tarjeta->cargar_saldo(100);
        $tarjeta->viaje(145);
        $this->assertEquals($tarjeta->saldotarjeta(),100-9.75);
        //Hago un segundo viaje en el mimso colectivo
        $tarjeta->viaje(145);
        $this->assertEquals($tarjeta->saldotarjeta(),100-19.50);
        //Ahora hago un transbordo
        $tarjeta->viaje(133);
        $this->assertEquals($tarjeta->saldotarjeta(),100-22.70);
        //Reinicio la carga en la tarjeta para simplificar los test
        $tarjeta->reiniciosaldo();
        //Ahora hacemos 1 viaje un transbordo y pagar un viaje a otra persona (9.75+ 3.2 + 9.75)
        $tarjeta->cargar_saldo(100);
        $tarjeta->viaje(139);
        $tarjeta->viaje(145);
        $tarjeta->viaje(145);
        $this->assertEquals($tarjeta->saldotarjeta(),100-22.70);
        //Reinicio el saldo
    }
    public function testAlquileBici() {
        $tarjeta = new Tarjeta;
        $tarjeta->cargar_saldo(100);
        //Alquilo una bici
        $tarjeta->alquilerbici();
        $this->assertEquals($tarjeta->saldotarjeta(),100-14.625);
        $tarjeta->alquilerbici();
        $this->assertEquals($tarjeta->saldotarjeta(),100-14.625);
        
    }
}
