<?php

/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 23/08/17
 * Time: 6:16 PM
 */

require "../config/Conexion.php";

class Producto
{


    /**
     * Producto constructor.
     */
    public function __construct()
    {

    }

    public function insert($nombre,$precio,$descripcion,$cantidad,$idmarca,$idcategoria,$imagen){

        $sql = "INSERT INTO PRODUCTO (nombre_producto,precio_producto,descripcion_producto,cantidad_producto,id_marca,id_categoria,imagen_producto,condicion)
                VALUES ('$nombre','$precio','$descripcion','$cantidad','$idmarca','$idcategoria','$imagen','1')";
        return execQuery($sql);

    }
    public function edit($idproducto,$nombre,$precio,$descripcion,$cantidad,$idmarca,$idcategoria,$imagen){

        //$sql = "UPDATE CATEGORIA SET nombre_categoria = '$nombreCat' WHERE  id_categoria = '$idcat'";
        $sql = "UPDATE PRODUCTO SET 
                  nombre_producto = '$nombre',
                  precio_producto = $precio,
                  descripcion_producto = '$descripcion',
                  cantidad_producto = $cantidad,
                  id_marca = $idmarca,
                  id_categoria = $idcategoria,
                  imagen_producto = '$imagen'
                 WHERE id_producto = $idproducto";
        //echo $sql;
        return execQuery($sql);

    }
    public function  desactivar($idproducto){
        $sql = "UPDATE PRODUCTO SET condicion = 0 WHERE  id_producto = '$idproducto'";
        return execQuery($sql);
    }

    public function  activar($idproducto){
        $sql = "UPDATE PRODUCTO SET condicion = 1 WHERE  id_producto = '$idproducto'";
        return execQuery($sql);
    }

    public function verProducto($idproducto){

        $sql = "SELECT * FROM PRODUCTO WHERE id_producto = '$idproducto'";
        return execQuerySimpleRow($sql);
    }
    public function listProducto(){

        $sql = "SELECT p.id_producto,p.id_categoria,p.id_marca,p.nombre_producto,p.precio_producto,p.descripcion_producto,p.descripcion_producto,p.cantidad_producto,p.condicion,m.nombre_marca as marca,c.nombre_categoria as categoria,p.imagen_producto
                FROM PRODUCTO p 
                INNER  JOIN CATEGORIA c on c.id_categoria = p.id_categoria
                INNER JOIN MARCA m on m.id_marca = p.id_marca";
        return execQuery($sql);
    }








}
?>