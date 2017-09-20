<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 19/09/17
 * Time: 5:07 PM
 */
require_once "../config/Conexion.php";
class Pedido
{


    /**
     * Pedido constructor.
     */
    public function __construct()
    {
    }

    public function agregarPedido($iduser,$idDir){

        $sql = "INSERT INTO PEDIDO_CLIENTE 
                (estado_pedido_cliente, calificacion_pedido_cliente, id_usuario, id_direccion) 
                VALUES ('p','0','$iduser','$idDir')";

        return execQuery($sql);

    }
    public function agregarDetalle($cant,$price,$id_pedido,$id_producto){
        $sql = "INSERT INTO DETALLE_VENTA (cantidad, precio_venta, id_pedido, id_producto) VALUES 
                ('$cant','$price','$id_pedido','$id_producto')";
        //echo $sql."<BR>";
        return execQuery($sql);
    }

    public function ultimoPedidoUsuario($iduser){
        $sql = "SELECT id_pedido_cliente FROM PEDIDO_CLIENTE
                WHERE id_usuario = '$iduser' ORDER  BY fecha_pedido_cliente DESC LIMIT 1";
        return execQuerySimpleRow($sql);
    }




}