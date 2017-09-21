<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 19/09/17
 * Time: 5:06 PM
 */


require_once "../models/Pedido.php";

$pedido = new Pedido();

$iduser = isset($_REQUEST["iduser"]) ? cleanString(($_REQUEST["iduser"]))  : "";
$iddir = isset($_REQUEST["iddir"]) ? cleanString(($_REQUEST["iddir"]))  : "";
$arrpro  = isset($_REQUEST["arrpro"]) ? $_REQUEST["arrpro"]: "";


switch ($_GET["op"]){
    case "nuevoPedido":

        $rspstapedido = $pedido->agregarPedido($iduser,$iddir);
        if ($rspstapedido){
            $resUltimoPedido = $pedido->ultimoPedidoUsuario($iduser);
            if (sizeof($resUltimoPedido) > 0){
                $idpedido = reset($resUltimoPedido);
                foreach ($arrpro as $val){
                    $pro = explode(";" ,$val);
                    //echo $pro[0]." "; -> idproducto
                    //echo $pro[1]; -> cantidad
                    //echo ", ";
                    $idpro = $pro[0];
                    $cant = $pro[1];
                    $resAgregarDetalle = $pedido->agregarDetalle($cant,0,$idpedido,$idpro);
                    //echo var_dump($resAgregarDetalle)."<BR>";
                }
                echo json_encode(array("validate" => true));
            }else {
                echo json_encode(array("validate" => false));
            }
        }else{
            echo json_encode(array("validate" => false));
        }
        break;

    case "listarPedidos":

        $resIdpedidos = $pedido->listaIdPedidos($iduser);
        $arrayIdPedidos = array();
        while ($r = $resIdpedidos->fetch_assoc()) {

            $id_pedido = $r['id_pedido'];
            array_push($arrayIdPedidos,$id_pedido);

        }

        $arrPedidos = array();
        foreach ($arrayIdPedidos as $id_pedido){


            $resPedido = $pedido->listarPedidosUsuario($iduser,$id_pedido);

            $resListProducto = $pedido->listarProductosPorPedido($iduser,$id_pedido);

            $arry_Productos = array();

            while ($rprod = $resListProducto->fetch_assoc()){
                $producto = array(
                    "id_producto" => $rprod["id_producto"],
                    "nombre_producto" => $rprod["nombre_producto"],
                    "imagen_producto" =>$rprod["imagen_producto"],
                    "precio_producto"=> $rprod["precio_producto"],
                    "cantidad" =>$rprod["cantidad"]
                );

                array_push($arry_Productos,$producto);

                //echo json_encode($producto);
                unset($producto);

            }
            unset($producto);

            $resPedido["productos"] = $arry_Productos;
            array_push($arrPedidos,$resPedido);
        }

        echo json_encode($arrPedidos);

        break;

}


?>