<?php

include_once("../entidades/TasaCambio.php");
include_once("../datos/DtTipoCambio.php");

$dem = new TasaCambio();
$dtDem = new DtTipoCambio();


if ($_POST) 
{
    $varAccion = $_POST['txtaccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {
                
                $dem->__SET('id_monedaO', $_POST['MonedaO']);
                $dem->__SET('id_monedaC', $_POST['MonedaC']);
				$dem->__SET('mes', $_POST['Mes']);
				$dem->__SET('anio', $_POST['anio']);
        
                $dtDem->registrarEmp($dem);
                //var_dump($emp);
                header("Location: ../dist/TblTasaCambio.php?msjNewTas=1");
            } 
            catch (Exception $e) 
            {
                header("Location: ../dist/TblTasaCambio.php?msjNewTas=2");
                die($e->getMessage());
            }
            break;
        
        case '2':
            try 
            {
                $emp->__SET('id_denominacion', $_POST['idDem']);
                $emp->__SET('valor', $_POST['valor']);
                $emp->__SET('valor_letras', $_POST['valor_letras']);
                $emp->__SET('idMoneda', $_POST['Moneda']);
        
                $dtDem->actualizarEmp($emp);
                //var_dump($emp);
                header("Location: ../dist/TblEmpleados.php?msjEditEmp=1");
            } 
            catch (Exception $e) 
            {
                header("Location: ../dist/TblEmpleados.php?msjEditEmp=2");
                die($e->getMessage());
            }
            break;
        
        default:
            # code...
            break;
    }

}

if ($_GET) 
{
    try 
    {
        $emp->__SET('employee_id', $_GET['delEmp']);
        $dtEmp->eliminarEmp($emp->__GET('employee_id'));
        header("Location: ../dist/TblEmpleados.php?msjDelEmp=1");
    }
    catch(Exception $e)
    {
        header("Location: ../dist/TblEmpleados.php?msjDelEmp=2");
        die($e->getMessage());
    }
}