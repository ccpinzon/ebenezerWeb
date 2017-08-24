<?php

/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 23/08/17
 * Time: 6:21 PM
 */
require "../config/Conexion.php";

class Marca
{

    public function __construct()
    {

    }

    public function insert($nombreMarca){

        $sql = "INSERT INTO MARCA (nombre_marca) VALUES ('$nombreMarca')";
        return execQuery($sql);

    }

    public function edit($idMarca,$nombreMarca){

        $sql = "UPDATE MARCA SET nombre_marca = '$nombreMarca' WHERE id_marca = '$idMarca'";
        return execQuery($sql);

    }

    public function verMarca($idMarca){

        $sql = "SELECT * FROM MARCA WHERE id_marca = '$idMarca'";
        return execQuerySimpleRow($sql);
    }
    public function listMarcas(){

        $sql = "SELECT * FROM MARCA";
        return execQuery($sql);
    }



}
?>