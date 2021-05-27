<?php
include_once("Connect.php");

class DtDenominacion extends Conexion
{
    private $myCon;

    public function listarDenom()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT * FROM VISTA_DENOMINACION";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$denom = new Denominacion();

				//_SET(CAMPOBD, atributoEntidad)			
				$denom->__SET('id_Denominacion',$r->id_Denominacion);
				$denom->__SET('nombre', $r->nombre);
				$denom->__SET('valor', $r->valor);
				$denom->__SET('valor_letras', $r->valor_letras);
				$denom->__SET('estado',$r->estado);
               
					

				$result[] = $denom;

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

	public function comboMoneda()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT id_moneda, nombre FROM tbl_Moneda WHERE estado <> 3;";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$emp = new Moneda();

				//_SET(CAMPOBD, atributoEntidad)			
				$emp->__SET('id_moneda', $r->id_moneda);
				$emp->__SET('nombre', $r->nombre);
				
				$result[] = $emp;

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
	
	public function comboDenominacion()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT id_denominacion, valor_letras FROM tbl_denominacion;";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$emp = new Denominacion();

				//_SET(CAMPOBD, atributoEntidad)			
				$emp->__SET('id_denominacion', $r->id_denominacion);
				$emp->__SET('valor_letras', $r->valor_letras);
				
				$result[] = $emp;

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

	public function registrarEmp(Denominacion $data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "INSERT INTO tbl_denominacion (valor,valor_letras,idMoneda,estado) 
		        VALUES (?, ?, ?, ?)";

			$this->myCon->prepare($sql)
		     ->execute(array(
			 $data->__GET('valor'),
			 $data->__GET('valor_letras'),
			 $data->__GET('idMoneda'),
			 $data->__SET('estado',1)));
			
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function obtenerDem($id)
	{
		try 
		{
			/*$this->myCon = parent::conectar();
			$querySQL = "SELECT * FROM VISTA_DENOMINACION WHERE id_Denominacion = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$emp = new VistaDenominacion();

			$emp->__SET('id_Denominacion', $r->id_Denominacion);
			$emp->__SET('nombre', $r->nombre);
			$emp->__SET('valor', $r->valor);
			$emp->__SET('valor_letras', $r-> valor_letras);
			$emp->__SET('estado',$r->estado);
			
			
			$this->myCon = parent::desconectar();
			return $emp;*/

			$this->myCon = parent::conectar();
			$querySQL = "SELECT * FROM tbl_denominacion WHERE id_Denominacion = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$emp = new Denominacion();

			$emp->__SET('id_Denominacion', $r->id_Denominacion);
			$emp->__SET('idMoneda', $r->idMoneda);
			$emp->__SET('valor', $r->valor);
			$emp->__SET('valor_letras', $r-> valor_letras);
			$emp->__SET('estado',$r->estado);
			
			
			$this->myCon = parent::desconectar();
			return $emp;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function actualizarEmp(Denominacion $data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "UPDATE tbl_denominacion SET 
						valor = ?, 
						valor_letras = ?,
						idMoneda = ?, 
						estado = ? 
				    WHERE id_Denominacion = ?";

				$this->myCon->prepare($sql)
			     ->execute(
				array(
					$data->__GET('valor'), 
					$data->__GET('valor_letras'), 
					$data->__GET('idMoneda'),
					$data->__SET('estado',2),
					$data->__GET('id_Denominacion')
					)
				);
				$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			var_dump($e);
			die($e->getMessage());
		}
	}

	public function eliminarEmp($id)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$querySQL = "DELETE FROM employees WHERE employee_id = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}



}