<?php

class VistaTipoCambio
{	
	private $id_tasaCambio;
	private $MonedaO;
	private $MonedaC;
    private $mes;
    private $anio;
	
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }

}