<?php

include_once("../entidades/Moneda.php");
include_once("../datos/DtMoneda.php");

$mon = new Moneda();
$dtMon = new DtMoneda();


if ($_POST) 
{
    $varAccion = $_POST['txtaccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {
                $mon->__SET('nombre', $_POST['nombre']);
                $mon->__SET('simbolo', $_POST['simbolo']);
				
				if (($dtMon->ExisteMoneda($_POST['nombre']) == null) and 
                    ($dtMon->ExisteSimbolo($_POST['simbolo']) == null)) {

                    $dtMon->registrarMon($mon);
                    header("Location: ../dist/TblMoneda.php?msjNewMon=1");
                    break;

                } else {
                    header("Location: ../dist/TblMoneda.php?msjNewMon=3");    
                    break;
                }
            } 
            catch (Exception $e) 
            {
                header("Location: ../dist/TblMoneda.php?msjNewMon=2");
                die($e->getMessage());
            }
            break;
        
        case '2':
            try 
            {
                $mon->__SET('id_moneda', $_POST['idMon']);
                $mon->__SET('nombre', $_POST['nombre']);
                $mon->__SET('simbolo', $_POST['simbolo']);
                $mon->__SET('estado', $_POST['estado']);
        
                if (($dtMon->ExisteMoneda($_POST['moneda']) == null) and 
                    ($dtMon->ExisteSimbolo($_POST['simbolo']) == null)) {

                    $dtMon->actualizarMon($mon);
                    header("Location: ../dist/TblMoneda.php?msjEditMon=1");
                    break;

                } else {
                    header("Location: ../dist/TblMoneda.php?msjEditMon=3");    
                    break;
                }
            } 
            catch (Exception $e) 
            {
                header("Location: ../dist/TblMoneda.php?msjEditMon=2");
                die($e->getMessage());
            }
            break;

        // case '3':
            // try 
            // {
                // $mon->__SET('id_moneda', $_POST['idMon']);
                // $mon->__SET('nombre', $_POST['nombre']);
                // $mon->__SET('simbolo', $_POST['simbolo']);
                // $mon->__SET('estado', $_POST['estado']);
        
                // $dtMon->actualizarMon($mon);
                //var_dump($emp);
                // header("Location: ../dist/TblMoneda.php?msjDelMon=1");
            // } 
            // catch (Exception $e) 
            // {
                // header("Location: ../dist/TblMoneda.php?msjDelMon=2");
                // die($e->getMessage());
            // }
            // break;
        
        default:
            # code...
            break;
    }

}

if ($_GET) 
{
    try 
    {
        $mon->__SET('id_moneda', $_GET['DelMon']);
        $dtMon->EliminarMoneda($mon->__GET('id_moneda'));
        header("Location: ../dist/TblMoneda.php?msjDelMon=1");
    }
    catch(Exception $e)
    {
        header("Location: ../dist/TblMoneda.php?msjDelMon=2");
        die($e->getMessage());
    }
}