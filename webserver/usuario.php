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


$dir = isset($_REQUEST["dir"]) ? cleanString(($_REQUEST["dir"]))  : "";
$iduser = isset($_REQUEST["iduser"]) ? cleanString(($_REQUEST["iduser"]))  : "";



switch ($_GET["op"]){

    case 'registrarCliente':

        if ($pass1 == $pass2){
            $clavehash = hash("SHA256",$pass2);
            $rspta = $usuario->insertCliente($nombres,$email,$clavehash,$tel);
            //echo json_encode(array("validate" => $rspta));
            if ($rspta){
                $datosUsuario = $usuario->verUsuarioEmail($email);
                $aux = json_encode($datosUsuario);
                $data = json_decode($aux);

                $data->validate = true;
                echo json_encode($data);
            }
        }else {
            echo json_encode(array("validate" => false));
        }

        break;

    case 'validarSesion':

        $clavehash = hash("SHA256",$pass1);

        $rspta = $usuario->verificarCliente($email,$clavehash);
        $fetch=$rspta->fetch_object();


        if (isset($fetch)){
            $datosUsuario = $usuario->verUsuarioEmail($email);
            $aux = json_encode($datosUsuario);
            $data = json_decode($aux);
            $data->validate = true;
            echo json_encode($data);
        }else{
            echo json_encode(array("validate" => false ));
        }

        break;

    case 'insertarDireccion':


        $rspta = $usuario->insertarDireccion($dir,$iduser);


        if ($rspta){
            echo json_encode(array("validate" => true));
        }else{
            echo json_encode(array("validate" => false ));
        }

        break;

    case 'listarDirecciones':

        $rspta = $usuario->listarDirecciones($iduser);
        $return_arr = Array();

        while ($r = $rspta->fetch_assoc()){
            $row_array['id_direccion'] = $r['id_direccion'];
            $row_array['nombre_direccion'] = $r['nombre_direccion'];
            array_push($return_arr,$row_array);
        }

        echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
        break;


}


?>