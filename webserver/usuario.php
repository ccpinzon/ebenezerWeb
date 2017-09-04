<?php
/**
 * Created by PhpStorm.
 * User: Cristhian Pinzon
 * Date: 04/09/2017
 * Time: 12:36 PM
 */
require_once "../models/Usuario.php";

$usuario = new Usuario();

//$idcategoria = isset($_POST["idcategoria"]) ? cleanString(($_POST["idcategoria"]))  : "";
$nombres = isset($_REQUEST["names"]) ? cleanString(($_REQUEST["names"]))  : "";
$email = isset($_REQUEST["email"]) ? cleanString(($_REQUEST["email"]))  : "";
$pass1 = isset($_REQUEST["pass1"]) ? cleanString(($_REQUEST["pass1"]))  : "";
$pass2 = isset($_REQUEST["pass2"]) ? cleanString(($_REQUEST["pass2"]))  : "";
$tel = isset($_REQUEST["tel"]) ? cleanString(($_REQUEST["tel"]))  : "";




switch ($_GET["op"]){

    case 'registrarCliente':

        if ($pass1 == $pass2){
            $clavehash = hash("SHA256",$pass2);
            $rspta = $usuario->insertCliente($nombres,$email,$clavehash,$tel);
            echo json_encode(array("validate" => $rspta));
        }else {
            echo json_encode(array("validate" => false));
        }

        break;

    case 'validarSesion':

        break;

}


?>