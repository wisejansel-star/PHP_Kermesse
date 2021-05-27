<?php
include_once("Connect.php");

class DtDetalleTasaCambio extends Conexion
{
    private $myCon;
	
	public function listarDetTasa($id)
	{
		try
		{
			// $this->myCon = parent::conectar();
			// $result = array();
			// $querySQL = "SELECT * FROM tasaCambio_det WHERE id_tasaCambio = ?";

			// $stm = $this->myCon->prepare($querySQL);
			// $stm->execute();
			
			$this->myCon = parent::conectar();
			$querySQL = "SELECT * FROM tasaCambio_det WHERE id_tasaCambio = 1";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			
			

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$emp = new DetalleTasaCambio();

				// _SET(CAMPOBD, atributoEntidad)
				 $emp->__SET('id_tasaCambio', $r->id_tasaCambio);
                 $emp->__SET('id_tasaCambio_det', $r->id_tasaCambio_det);				
				 // $emp->__SET('id_tasaCambio', $r->id_tasaCambio);
			     $emp->__SET('fecha', $r->fecha);
			     $emp->__SET('tipoCambio', $r->tipoCambio);	
				 $emp->__SET('estado',$r->estado);

				$result[] = $emp;

				// var_dump($result);
				$this->myCon = parent::desconectar();
				return $result;
			}
			// $this->myCon = parent::desconectar();
			// return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
		
		/*try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT * FROM tasaCambio_det WHERE id_tasaCambio = ?";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mon = new DetalleTasaCambio();

				//_SET(CAMPOBD, atributoEntidad)			
				 $mon->__SET('id_tasaCambio', $r->id_tasaCambio);
                 $mon->__SET('id_tasaCambio_det', $r->id_tasaCambio_det);				
			     $mon->__SET('fecha', $r->fecha);
			     $mon->__SET('tipoCambio', $r->tipoCambio);	
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
		}*/
		
		
	}


	public function comboJefe()
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT employee_id, first_name, last_name FROM hr.employees 
			WHERE employee_id IN (SELECT manager_id FROM hr.employees GROUP BY manager_id);";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$emp = new Empleado();

				//_SET(CAMPOBD, atributoEntidad)			
				$emp->__SET('employee_id', $r->employee_id);
				$emp->__SET('first_name', $r->first_name);
				$emp->__SET('last_name', $r->last_name);
				
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

	public function registrarEmp(Empleado $data)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$sql = "INSERT INTO EMPLOYEES (first_name,last_name,email,phone_number,hire_date,job_id,salary,commission_pct,manager_id,department_id) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$this->myCon->prepare($sql)
		     ->execute(array(
			 $data->__GET('first_name'),
			 $data->__GET('last_name'),
			 $data->__GET('email'),
			 $data->__GET('phone_number'),
			 $data->__GET('hire_date'),
			 $data->__GET('job_id'),
			 $data->__GET('salary'),
			 $data->__GET('commission_pct'),
			 $data->__GET('manager_id'),
			 $data->__GET('department_id')));
			
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function obtenerDetTasa($id)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$querySQL = "SELECT * FROM tasaCambio_det";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($id));
			
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$emp = new DetalleTasaCambio();
			
			
			$emp->__SET('id_tasaCambio_det',$r->id_tasaCambio_det);
            $emp->__SET('id_tasaCambio', $r->id_tasaCambio);
			$emp->__SET('fecha', $r->fecha);
			$emp->__SET('tipoCambio', $r->tipoCambio);
			$emp->__SET('estado',$r->estado);
			
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