<?php
include_once("Connect.php");

class DtTipoCambio extends Conexion
{
    private $myCon;

    public function listarTip()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT * FROM VISTA_TIPOCAMBIO";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$tip = new TasaCambio();

				//_SET(CAMPOBD, atributoEntidad)	
                $tip->__SET('id_tasaCambio',$r->id_tasaCambio);				
				$tip->__SET('MonedaO', $r->MonedaO);
				$tip->__SET('MonedaC', $r->MonedaC);
				$tip->__SET('mes', $r->mes);
				$tip->__SET('anio', $r->anio);
               
					

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

	public function comboMoneda()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT id_moneda, nombre FROM tbl_Moneda;";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$emp = new TasaCambio();

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

	public function registrarEmp(TasaCambio $data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "INSERT INTO tbl_tasaCambio (id_monedaO,id_monedaC,mes,anio,estado) 
		        VALUES (?, ?, ?, ?, ?)";

			$this->myCon->prepare($sql)
		     ->execute(array(
			 $data->__GET('id_monedaO'),
			 $data->__GET('id_monedaC'),
			 $data->__GET('mes'),
			 $data->__GET('anio'),
			 $data->__SET('estado',1)));
			
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function obtenerEmp($id)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$querySQL = "SELECT * FROM tbl_tasaCambio WHERE id_tasaCambio = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$emp = new TasaCambio();

			$emp->__SET('id_tasaCambio', $r->id_tasaCambio);
			$emp->__SET('id_monedaO', $r->id_monedaO);
			$emp->__SET('id_monedaC', $r->id_monedaC);
			$emp->__SET('mes', $r->mes);
			$emp->__SET('anio', $r->anio);
			$emp->__SET('estado', $r->estado);
			$this->myCon = parent::desconectar();
			return $emp;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function actualizarEmp(Empleado $data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "UPDATE EMPLOYEES SET 
						first_name = ?, 
						last_name = ?,
						email = ?, 
						phone_number = ?,
						hire_date = ?, 
						job_id = ?,
						salary = ?, 
						commission_pct = ?,
						manager_id = ?,
						department_id = ? 
				    WHERE employee_id = ?";

				$this->myCon->prepare($sql)
			     ->execute(
				array(
					$data->__GET('first_name'), 
					$data->__GET('last_name'), 
					$data->__GET('email'),
					$data->__GET('phone_number'),
					$data->__GET('hire_date'),
					$data->__GET('job_id'), 
					$data->__GET('salary'), 
					$data->__GET('commission_pct'),
					$data->__GET('manager_id'),
					$data->__GET('department_id'),
					$data->__GET('employee_id')
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