<?php
include_once("Connect.php");


class DtMoneda extends Conexion
{
    private $myCon;

    public function listarMon()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT * FROM tbl_moneda WHERE estado = 1 OR estado=2";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mon = new Moneda();

				//_SET(CAMPOBD, atributoEntidad)			
				$mon->__SET('id_moneda', $r->id_moneda);
				$mon->__SET('nombre', $r->nombre);
				$mon->__SET('simbolo', $r->simbolo);
				$mon->__SET('estado',$r->estado);	

				$result[] = $mon;

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

	public function registrarMon(Moneda $data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "INSERT INTO tbl_moneda (nombre,simbolo,estado) 
		        VALUES (?, ?, ?)";

			$this->myCon->prepare($sql)
		     ->execute(array(
			 $data->__GET('nombre'),
			 $data->__GET('simbolo'),
			 $data->__SET('estado',1)));
			
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function obtenerMon($id)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$querySQL = "SELECT * FROM tbl_moneda WHERE id_moneda = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$mon = new Moneda();

			$mon->__SET('id_moneda', $r->id_moneda);
			$mon->__SET('nombre', $r->nombre);
			$mon->__SET('simbolo', $r->simbolo);
			$mon->__SET('estado', $r->estado);
			$this->myCon = parent::desconectar();
			return $mon;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function actualizarMon(Moneda $data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "UPDATE tbl_moneda SET 
						nombre = ?, 
						simbolo = ?,
						estado = ?
				    WHERE id_moneda = ?";

				$this->myCon->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('simbolo'),
					$data->__SET('estado',2),
					$data->__GET('id_moneda')
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

	public function eliminarMon($data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "UPDATE tbl_moneda SET 
						nombre = ?, 
						simbolo = ?,
						estado = ?
				    WHERE id_moneda = ?";

				$this->myCon->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('simbolo'),
					$data->__SET('estado',3),
					$data->__GET('id_moneda')
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
			$querySQL = "UPDATE tbl_moneda SET estado=3 WHERE id_moneda = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	public function ExisteMoneda($a)
        {
            try
            {
                $this->myCon = parent::conectar();
                $querySQL = "SELECT * FROM tbl_moneda WHERE nombre = ? AND estado<>3;";
    
                $stm = $this->myCon->prepare($querySQL);
                $stm->execute(array($a));

                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
                {
                    $moneda = new Moneda();
    
                    //_SET(CAMPOBD, atributoEntidad)			
                    $moneda->__SET('nombre', $r->nombre);
                    $moneda->__SET('simbolo', $r->simbolo);
                    
                    $result = $moneda;
    
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
		
    public function ExisteSimbolo($a)
        {
            try
            {
                $this->myCon = parent::conectar();
                $querySQL = "SELECT * FROM tbl_moneda WHERE simbolo = ? AND estado<>3;";
    
                $stm = $this->myCon->prepare($querySQL);
                $stm->execute(array($a));

                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
                {
                    $moneda = new Moneda();
    
                    //_SET(CAMPOBD, atributoEntidad)			
                    $moneda->__SET('simbolo', $r->simbolo);
                    
                    $result[] = $moneda;
    
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
		
    public function EliminarMoneda($data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "UPDATE tbl_moneda SET 
						estado = 3
				    WHERE id_moneda = ?";

				$this->myCon->prepare($sql)
			     ->execute(
				array(
					$data
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



}