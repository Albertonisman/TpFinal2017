<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {
    public function SetUp() {
        protected $tarjeta = new Tarjeta;
        protected $c145 = new Colectivo(145);
        protected $c133 = new Colectivo(133); 
        protected $c139 = new Colectivo(139);
        protected $bici = new Bicicleta(1234);
    }

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testCargarSaldo50() {
        $this->tarjeta->cargar_saldo(50);
        $this->assertEquals($this->tarjeta->saldotarjeta(), 50);
    }
    public function testCargarSaldo332() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->cargar_saldo(332);
        $this->assertEquals($this->tarjeta->saldotarjeta(),388);
    }
    public function testCargarSaldo624() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->cargar_saldo(624);
        $this->assertEquals($this->tarjeta->saldotarjeta(),776);
    }
    public function testUnViaje() {
        $this->tarjeta->viaje($this->c139,'01/01/2017 23:00');
        $this->assertEquals($this->tarjeta->saldotarjeta(),776-9.75);
        $v = $this->tarjeta->viajes_r();
        $this->assertEquals($v[0]->obtener_tipo(),'Normal');
        $this->assertEquals($v[0]->obtener_monto(),9.75);
        $this->assertEquals($v[0]->obtener_transporte(),145);
        $this->assertEquals($v[0]->obtener_fecha_y_hora(),'01/01/2017 23:00');
    }
    public function testDosViajes() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->cargar_saldo(100);
        $this->tarjeta->viaje($this->c145,'01/01/2017 20:20');
        $this->tarjeta->viaje($this->c145,'01/01/2017 20:10');
        $this->assertEquals($this->tarjeta->saldotarjeta(),100-19.50);
    }
    public function testTransbordo() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->cargar_saldo(100);
        $this->tarjeta->viaje($this->c145,'01/01/2017 20:20');
        $this->tarjeta->viaje($this->c133,'01/01/2017 20:30');
        $this->assertEquals($this->tarjeta->saldotarjeta(),100-(9.75+3.20));
    }
    public function testTresViajes() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->cargar_saldo(100);
        $this->tarjeta->viaje($this->c139,'01/01/2017 23:00');
        $this->tarjeta->viaje($this->c145,'01/01/2017 23:10');
        $this->tarjeta->viaje($this->c145,'01/01/2017 23:11');
        $this->assertEquals($this->tarjeta->saldotarjeta(),100-22.70);   
    }
    public function testBici() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->cargar_saldo(100);
        $this->assertEquals($this->bici->obtener_matricula(),1234);
        $this->tarjeta->viaje($this->bici,'02/01/2017 20:00');
        $this->assertEquals($this->tarjeta->saldotarjeta(),100-14.625);    
    }
    public function testBici2() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->cargar_saldo(100);
        $this->tarjeta->viaje($this->bici,'02/01/2017 20:00');
        $this->tarjeta->viaje($this->bici,'02/01/2017 22:00');
        $this->assertEquals($this->tarjeta->saldotarjeta(),100-14.625);
    }
    public function testViajePlus() {
        $this->tarjeta->reiniciosaldo();
        $this->tarjeta->viaje($this->c139,'01/01/2017 23:00');
        $this->assertEquals($this->tarjeta->plusTarjeta(),1);
        $this->tarjeta->viaje($this->c139,'01/01/2017 23:10');
        $this->assertEquals($this->tarjeta->plusTarjeta(),2);
        $this->tarjeta->cargar_saldo(100);
        $this->tarjeta->viaje($this->c139,'01/01/2017 23:20');
        $this->assertEquals($this->tarjeta->saldotarjeta(),100-9.75*3);
        $this->assertEquals($this->tarjeta->plusTarjeta(),0);  
    }
}
