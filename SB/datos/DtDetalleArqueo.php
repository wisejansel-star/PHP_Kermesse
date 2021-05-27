<?php
include_once("Connect.php");

class DtDetalleArqueo extends Conexion
{
    private $myCon;

    public function listarTip()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT * FROM VISTA_DETALLEARQUEO";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$tip = new DetalleArqueoCaja();

				//_SET(CAMPOBD, atributoEntidad)	
                $tip->__SET('idArqueoCaja_Det',$r->idArqueoCaja_Det);				
				$tip->__SET('nombre', $r->nombre);
				$tip->__SET('valor_letras', $r->valor_letras);
				$tip->__SET('cantidad', $r->cantidad);
				$tip->__SET('subtotal', $r->subtotal);
               
					

				$result[] = $tip;

				//var_dump($result);
			}
			$this->myCon = parent::desconectar();
			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	



}