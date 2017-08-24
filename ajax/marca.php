<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 23/08/17
 * Time: 6:27 PM
 */

require_once "../models/Marca.php";

$marca = new Marca();

$idmarca = isset($_POST["idmarca"]) ? cleanString(($_POST["idmarca"])) : "";
$nombremarca = isset($_POST["nombre"]) ? cleanString(($_POST["nombre"])) : "";

switch ($_GET["op"]){
    case 'guardaryeditar':
        if (empty($idmarca)){
            $rspta = $marca->insert($nombremarca);
            //echo var_dump($rspta);
            echo $rspta ? "Marca Registrada" : "Error al registrar la Marca";
        }else{
            $rspta = $marca->edit($idmarca,$nombremarca);
            echo $rspta ? "Marca Actualizada" : "Error al actualizar la Marca";
        }

    break;
    case 'mostrar':
        $rspta = $marca->verMarca($idmarca);
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $marca->listMarcas();
        $data = Array();

        while ($reg = $rspta->fetch_object()){
            $data[] = array(
              "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_marca.')"><i class="fa fa-pencil"></i>  Editar</button>',
              "1"=>$reg->nombre_marca
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
}

?>