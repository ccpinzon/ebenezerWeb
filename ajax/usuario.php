<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 30/08/17
 * Time: 3:11 PM
 */

session_start();

require_once "../models/Usuario.php";


$usuario = new Usuario();

$idusuario = isset($_POST["idusuario"]) ? cleanString(($_POST["idusuario"]))  : "";
$nombres = isset($_POST["nombres"]) ? cleanString(($_POST["nombres"]))  : "";
$email = isset($_POST["email"]) ? cleanString(($_POST["email"]))  : "";
$tipo_usuario = isset($_POST["tipo_usuario"]) ? cleanString(($_POST["tipo_usuario"]))  : "";
$pass = isset($_POST["pass"]) ? cleanString(($_POST["pass"]))  : "";
$tel = isset($_POST["tel"]) ? cleanString(($_POST["tel"]))  : "";


switch ($_GET["op"]){
    case 'guardaryeditar':
        // hash password

        $clavehash = hash("SHA256",$pass);



        if (empty($idusuario)){
            $rspta = $usuario->insert($nombres,$email,$clavehash,$tel);
            echo $rspta ? "Usuario Registrado" : "Error al registrar el Usuario";
        }
        else {
            $rspta = $usuario->edit($idusuario,$nombres,$email,$clavehash,$tel);
            echo $rspta ? "Usuario Actualizado" : "Error al actualizar el Usuario";
        }
        break;

    case 'mostrar':
        $rspta = $usuario->verUsuario($idusuario);
        echo json_encode($rspta);
        break;

    case 'listarC':
        $rspta = $usuario->listUsuarioC();
        $data = Array();

        while ($reg=$rspta->fetch_object()){
            $data[] = array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i>  Editar</button>',
//                    .' <button class="btn btn-danger" onclick="eliminar('.$reg->id_usuario.')"><i class="fa fa-close"></i> Desactivar</button>',
                "1"=>$reg->nombres_usuario,
                "2"=>$reg->email_usuario,
                "3"=>$reg->telefono_usuario
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data
        );
        echo json_encode($results);
        break;


        case 'listarA':
        $rspta = $usuario->listUsuarioA();
        $data = Array();

        while ($reg=$rspta->fetch_object()){
            $data[] = array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i>  Editar</button>',
//                    .' <button class="btn btn-danger" onclick="eliminar('.$reg->id_usuario.')"><i class="fa fa-close"></i> Desactivar</button>',
                "1"=>$reg->nombres_usuario,
                "2"=>$reg->email_usuario,
                "3"=>$reg->telefono_usuario
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data
        );
        echo json_encode($results);
        break;


    case  'verificar':


        $email=$_POST['email'];
        $clave=$_POST['pass'];

        $clavehash = hash("SHA256",$clave);

        $rspta=$usuario->verificar($email,$clavehash);

        $fetch=$rspta->fetch_object();

        if (isset($fetch)){
            // variables de sesion
            $_SESSION['idusuario']=$fetch->id_usuario;
            $_SESSION['nombres']=$fetch->nombres_usuario;
            $_SESSION['email']=$fetch->email_usuario;
            $_SESSION['tel']=$fetch->telefono_usuario;
        }

        echo json_encode($fetch);
        break;

    case 'salir':

        // limpiar variables de session

        session_unset();
        session_destroy();

        header("Location: ../index.php");

        break;



}


?>