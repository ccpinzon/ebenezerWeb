<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 2/08/17
 * Time: 5:35 PM
 */

require_once "../models/Categoria.php";

$categoria =  new Categoria();

$idcategoria = isset($_POST["idcategoria"]) ? cleanString(($_POST["idcategoria"]))  : "";
$nombrecategoria = isset($_POST["nombre"]) ? cleanString(($_POST["nombre"])) : "" ;


switch ($_GET["op"]){
    case 'guardaryeditar':
        if (empty($idcategoria)){
            $rspta = $categoria->insert($nombrecategoria);
            echo $rspta ? "Categoria Registrada" : "Error al registrar la categoria";
        }
        else {
            $rspta = $categoria->edit($idcategoria,$nombrecategoria);
            echo $rspta ? "Categoria Actualizada" : "Error al actualizar la categoria";
        }
        break;

    case 'mostrar':
        $rspta = $categoria->verCategoria($idcategoria);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $categoria->listCategorias();
        $data = Array();
        
        while ($reg=$rspta->fetch_object()){
            $data[] = array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_categoria.')"><i class="fa fa-pencil"></i>  Editar</button>',
                "1"=>$reg->nombre_categoria
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