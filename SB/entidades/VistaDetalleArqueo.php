<?php

class VistaDetalleArqueo
{	
	private $idArqueoCaja_Det;
	private $nombre;
	private $valor_letras;
	private $cantidad;
    private $subtotal;
	
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }

}