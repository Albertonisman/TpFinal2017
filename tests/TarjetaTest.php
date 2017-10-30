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
        $c145 = new Colectivo(145);
        $c133 = new Colectivo(133); 
        $c139 = new Colectivo(139);
        $tarjeta->viaje($c145);
        $this->assertEquals($tarjeta->saldotarjeta(),100-9.75);
        //Hago un segundo viaje en el mimso colectivo
        $tarjeta->viaje($c145);
        $this->assertEquals($tarjeta->saldotarjeta(),100-19.50);
        //Ahora hago un transbordo
        $tarjeta->viaje($c133);
        $this->assertEquals($tarjeta->saldotarjeta(),100-22.70);
        //Reinicio la carga en la tarjeta para simplificar los test
        $tarjeta->reiniciosaldo();
        //Ahora hacemos 1 viaje un transbordo y pagar un viaje a otra persona (9.75+ 3.2 + 9.75)
        $tarjeta->cargar_saldo($100);
        $tarjeta->viaje($c139);
        $tarjeta->viaje($c145);
        $tarjeta->viaje($c145);
        $this->assertEquals($tarjeta->saldotarjeta(),100-22.70);
        $tarjeta->reiniciosaldo();
        $tarjeta->cargar_saldo(100);
        //Alquilo una bici
        $bici = new Bicicleta(1234);
        $tarjeta->viaje($bici);
        $this->assertEquals($tarjeta->saldotarjeta(),100-14.625);
        $tarjeta->viaje($bici);
        $this->assertEquals($tarjeta->saldotarjeta(),100-14.625);
    }
}
