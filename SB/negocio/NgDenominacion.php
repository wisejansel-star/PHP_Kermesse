<?php

include_once("../entidades/Denominacion.php");
include_once("../datos/DtDenominacion.php");

$dem = new Denominacion();
$dtDem = new DtDenominacion();


if ($_POST) 
{
    $varAccion = $_POST['txtaccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {
                
                $dem->__SET('valor', $_POST['valor']);
                $dem->__SET('valor_letras', $_POST['valor_letras']);
				$dem->__SET('idMoneda', $_POST['Moneda']);
        
                $dtDem->registrarEmp($dem);
                //var_dump($emp);
                header("Location: ../dist/TblDenominacion.php?msjNewDem=1");
            } 
            catch (Exception $e) 
            {
                header("Location: ../dist/TblDenominacion.php?msjNewDem=2");
                die($e->getMessage());
            }
            break;
        
        case '2':
            try 
            {
                $dem->__SET('id_Denominacion', $_POST['idDem']);
                $dem->__SET('valor', $_POST['valor']);
                $dem->__SET('valor_letras', $_POST['valor_letras']);
                $dem->__SET('idMoneda', $_POST['Moneda']);
                $dem->__SET('estado', $_POST['estado']);
        
                $dtDem->actualizarEmp($dem);
                //var_dump($emp);
                header("Location: ../dist/TblDenominacion.php?msjEditDem=1");
            } 
            catch (Exception $e) 
            {
                header("Location: ../dist/TblDenominacion.php?msjEditDem=2");
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