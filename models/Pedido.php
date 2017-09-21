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

    public function listaIdPedidos($iduser){

        $sql = "SELECT DISTINCT id_pedido_cliente AS id_pedido 
                FROM PEDIDO_CLIENTE PE
                INNER JOIN DETALLE_VENTA DE ON DE.id_pedido = PE.id_pedido_cliente
                WHERE id_usuario = $iduser";
        //echo $sql;
        return execQuery($sql);

    }

    public function listarPedidosUsuario($iduser, $id_pedido)
    {

        $sql =  "SELECT det.id_pedido,SUM(pr.precio_producto * det.cantidad) total,dir.nombre_direccion direccion, pc.fecha_pedido_cliente fecha,pc.estado_pedido_cliente estado, usr.id_usuario,usr.email_usuario 
                  FROM DETALLE_VENTA det 
                  INNER JOIN PEDIDO_CLIENTE pc ON pc.id_pedido_cliente = det.id_pedido 
                  INNER JOIN PRODUCTO pr ON pr.id_producto = det.id_producto 
                  INNER JOIN DIRECCION dir ON dir.id_direccion = pc.id_direccion 
                  INNER JOIN USUARIO usr on usr.id_usuario = pc.id_usuario 
                  WHERE pc.id_usuario = $iduser 
                  AND det.id_pedido = $id_pedido ";

        return execQuerySimpleRow($sql);

    }

    public function listarProductosPorPedido($iduser,$id_pedido){
        $sql = "SELECT pr.id_producto,pr.nombre_producto,pr.imagen_producto,pr.precio_producto,det.cantidad 
                FROM DETALLE_VENTA det 
                INNER JOIN PEDIDO_CLIENTE pc ON pc.id_pedido_cliente = det.id_pedido
                INNER JOIN PRODUCTO pr ON pr.id_producto = det.id_producto
                WHERE pc.id_usuario = $iduser
                AND id_pedido = $id_pedido";

        //echo $sql;

        return execQuery($sql);
    }


}