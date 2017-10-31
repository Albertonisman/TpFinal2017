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
        $tarjeta->viaje($c145,'01/01/2017 20:00');
        $this->assertEquals($tarjeta->saldotarjeta(),100-9.75);
        $this->assertEquals($tarjeta->viajes_realizados[0]->obtener_tipo(),'Normal');
        $this->assertEquals($tarjeta->viajes_realizados[0]->obtener_monto(),9.75);
        $this->assertEquals($tarjeta->viajes_realizados[0]->obtener_transporte(),145);
        $this->assertEquals($tarjeta->viajes_realizados[0]->obtener_fecha_y_hora(),'01/01/2017 20:00');
        //Hago un segundo viaje en el mimso colectivo
        $tarjeta->viaje($c145,'01/01/2017 20:10');
        $this->assertEquals($tarjeta->saldotarjeta(),100-19.50);
        //Ahora hago un transbordo
        $tarjeta->viaje($c133,'01/01/2017 20:30');
        $this->assertEquals($tarjeta->saldotarjeta(),100-22.70);
        //Reinicio la carga en la tarjeta para simplificar los test
        $tarjeta->reiniciosaldo();
        //Ahora hacemos 1 viaje un transbordo y pagar un viaje a otra persona (9.75+ 3.2 + 9.75)
        $tarjeta->cargar_saldo(100);
        $tarjeta->viaje($c139,'01/01/2017 23:00');
        $tarjeta->viaje($c145,'01/01/2017 23:10');
        $tarjeta->viaje($c145,'01/01/2017 23:11');
        $this->assertEquals($tarjeta->saldotarjeta(),100-22.70);
        $tarjeta->reiniciosaldo();
        $tarjeta->cargar_saldo(100);
        //Alquilo una bici
        $bici = new Bicicleta(1234);
        $this->assertEquals($bici->obtener_matricula(),1234);
        $tarjeta->viaje($bici,'02/01/2017 20:00');
        $this->assertEquals($tarjeta->saldotarjeta(),100-14.625);
        $tarjeta->viaje($bici,'01/01/2017 21:00');
        $this->assertEquals($tarjeta->saldotarjeta(),100-14.625);
        $tarjeta->reiniciosaldo();
        $tarjeta->viaje($c139,'01/01/2017 23:00');
        $this->assertEquals($tarjeta->plus,1);
        $tarjeta->viaje($c139,'01/01/2017 23:10');
        $this->assertEquals($tarjeta->plus,2);
        $tarjeta->cargar_saldo(100);
        $tarjeta->viaje($c139,'01/01/2017 23:20');
        $this->asserEquals($tarjeta->saldotarjeta(),100-9.75*3);
        $this->assertEquals($tarjeta->plus,0);  
    }
}
