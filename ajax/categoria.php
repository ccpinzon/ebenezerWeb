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
    case 'desactivar':
        $rspta=$categoria->desactivarCategoria($idcategoria);
        echo $rspta ? "Categoria actualizada" : "Error no se puede desactivar la categoria";
    break;

    case 'activar':
        $rspta=$categoria->activarCategoria($idcategoria);
        echo $rspta ? "Categoria actualizada" : "Error no se puede activar la categoria";
    break;

    case 'listar':
        $rspta = $categoria->listCategorias();
        $data = Array();
        
        while ($reg=$rspta->fetch_object()){
            $data[] = array(
                "0"=>($reg->condicion) ? '<button class="btn btn-warning" onclick="mostrar('.$reg->id_categoria.')"><i class="fa fa-pencil"></i>  Editar</button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->id_categoria.')"><i class="fa fa-close"></i> Desactivar</button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->id_categoria.')"><i class="fa fa-pencil"></i>  Editar</button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->id_categoria.')"><i class="fa fa-check"></i> Activar</button>',
                "1"=>$reg->nombre_categoria,
                "2"=>($reg->condicion) ? '<span class="label bg-green">Activo</span>' : '<span class="label bg-red">Inactivo</span>'
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