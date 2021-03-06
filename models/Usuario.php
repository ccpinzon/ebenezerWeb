<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 30/08/17
 * Time: 1:55 PM
 */

require "../config/Conexion.php";

class Usuario
{


    /**
     * Categoria constructor.
     */
    public function __construct()
    {

    }

    public function insert($nombres,$email,$hashpass,$tel){

        $sql = "INSERT INTO USUARIO 
                (nombres_usuario, email_usuario, tipo_usuario, hashpass_usuario, telefono_usuario) VALUES 
                ('$nombres','$email','A','$hashpass','$tel')";
        return execQuery($sql);

    }

    public function insertCliente($nombres,$email,$hashpass,$tel){

        $sql = "INSERT INTO USUARIO 
                (nombres_usuario, email_usuario, tipo_usuario, hashpass_usuario, telefono_usuario) VALUES 
                ('$nombres','$email','C','$hashpass','$tel')";
        return execQuery($sql);

    }

    public function edit($idusuario,$nombres,$email,$hashpass,$tel){

        $sql = "UPDATE USUARIO SET 
                nombres_usuario = '$nombres',
                email_usuario = '$email',
                hashpass_usuario = '$hashpass',
                telefono_usuario = '$tel'
                WHERE id_usuario = '$idusuario'
                ";
        return execQuery($sql);

    }

    public function verUsuario($idusuario){

        $sql = "SELECT * FROM USUARIO WHERE id_usuario = '$idusuario'";
        return execQuerySimpleRow($sql);
    }

    public function verUsuarioEmail($email){

        $sql = "SELECT * FROM USUARIO WHERE email_usuario = '$email' AND tipo_usuario = 'C'";
        return execQuerySimpleRow($sql);
    }
    public function listUsuarioA(){

        $sql = "SELECT * FROM USUARIO";
        return execQuery($sql);
    }
    public function listUsuarioC(){

        $sql = "SELECT * FROM USUARIO WHERE tipo_usuario = 'C'";
        return execQuery($sql);
    }


    // verificar acceso al sistema

    public function verificar($email,$clave){
        $sql = "SELECT id_usuario,nombres_usuario,email_usuario,telefono_usuario FROM USUARIO
                WHERE email_usuario = '$email' AND hashpass_usuario = '$clave'";
        return execQuery($sql);
    }


    public function verificarCliente($email,$clave){
        $sql = "SELECT id_usuario,nombres_usuario,email_usuario,telefono_usuario FROM USUARIO
                WHERE email_usuario = '$email' AND hashpass_usuario = '$clave' AND tipo_usuario = 'C'";
        return execQuery($sql);
    }

    public function insertarDireccion($direccion,$iduser){
        $sql = "INSERT INTO DIRECCION (nombre_direccion,id_usuario) VALUES 
                ('$direccion','$iduser')";
        return execQuery($sql);
    }

    public function listarDirecciones($iduser){
        $sql = "SELECT id_direccion,nombre_direccion FROM DIRECCION WHERE id_usuario = '$iduser'";
        return execQuery($sql);
    }





}