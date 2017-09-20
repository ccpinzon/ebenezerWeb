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

}


?>