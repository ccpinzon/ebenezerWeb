<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 2/08/17
 * Time: 4:55 PM
 */

require "../config/Conexion.php";

Class Categoria {


    /**
     * Categoria constructor.
     */
    public function __construct()
    {

    }

    public function insert($nombreCat){

        $sql = "INSERT INTO CATEGORIA (nombre_categoria) VALUES ('$nombreCat')";
        return execQuery($sql);

    }

    public function edit($idcat,$nombreCat){

        $sql = "UPDATE CATEGORIA SET nombre_categoria = '$nombreCat' WHERE  id_categoria = '$idcat'";
        return execQuery($sql);

    }

    public function verCategoria($idcat){

        $sql = "SELECT * FROM CATEGORIA WHERE id_categoria = '$idcat'";
        return execQuerySimpleRow($sql);
    }
    public function listCategorias(){

        $sql = "SELECT * FROM CATEGORIA";
        return execQuery($sql);
    }

    public function listCategoriasActivas(){

        $sql = "SELECT * FROM CATEGORIA WHERE condicion = 1";
        return execQuery($sql);
    }

    public function  desactivarCategoria($idcat){
        $sql = "UPDATE CATEGORIA SET condicion = 0 WHERE id_categoria = '$idcat'";
        return execQuery($sql);
    }

    public function activarCategoria($idcat){
        $sql = "UPDATE CATEGORIA SET condicion = 1 WHERE id_categoria = '$idcat'";
        return execQuery($sql);
    }

    public function select(){

        $sql = "SELECT * FROM CATEGORIA WHERE  condicion = 1";
        return execQuery($sql);
    }



}
?>